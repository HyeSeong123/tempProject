package com.codingsepo.example.demo.service;

import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Service;
import org.springframework.web.multipart.MultipartFile;
import org.springframework.web.multipart.MultipartRequest;

import com.codingsepo.example.demo.dao.GenFileDao;
import com.codingsepo.example.demo.dto.GenFile;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.util.Util;
import com.google.common.base.Joiner;

@Service
public class GenFileService {
	@Value("${custom.genFileDirPath}")
	private String genFileDirPath;

	@Autowired
	private GenFileDao genFileDao;

	public ResultData saveMeta(String relTypeCode, int relNum, String typeCode, String type2Code, int fileNo,
			String originFileName, String fileExtTypeCode, String fileExtType2Code, String fileExt, int fileSize,
			String fileDir) {

		Map<String, Object> param = Util.mapOf("relTypeCode", relTypeCode, "relNum", relNum, "typeCode", typeCode,
				"type2Code", type2Code, "fileNo", fileNo, "originFileName", originFileName, "fileExtTypeCode",
				fileExtTypeCode, "fileExtType2Code", fileExtType2Code, "fileExt", fileExt, "fileSize", fileSize,
				"fileDir", fileDir);
		genFileDao.saveMeta(param);

		int num = Util.getAsInt(param.get("num"), 0);
		return new ResultData("S-1", "성공하였습니다.", "num", num);
	}

	public ResultData save(MultipartFile multipartFile, int relNum) {
		String fileInputName = multipartFile.getName();
		String[] fileInputNameBits = fileInputName.split("__");

		if (fileInputNameBits[0].equals("file") == false) {
			return new ResultData("F-1", "파라미터명이 올바르지 않습니다.");
		}

		int fileSize = (int) multipartFile.getSize();

		if (fileSize <= 0) {
			return new ResultData("F-2", "파일이 업로드 되지 않았습니다.");
		}
		System.out.println("fileInputName=" + fileInputName);
		String relTypeCode = fileInputNameBits[1];
		String typeCode = fileInputNameBits[3];
		String type2Code = fileInputNameBits[4];
		int fileNo = Integer.parseInt(fileInputNameBits[5]);
		String originFileName = multipartFile.getOriginalFilename();
		String fileExtTypeCode = Util.getFileExtTypeCodeFromFileName(multipartFile.getOriginalFilename());
		String fileExtType2Code = Util.getFileExtType2CodeFromFileName(multipartFile.getOriginalFilename());
		String fileExt = Util.getFileExtFromFileName(multipartFile.getOriginalFilename().toLowerCase());

		if (fileExt.equals("jpeg")) {
			fileExt = " jpg";
		} else if (fileExt.equals("htm")) {
			fileExt = " html";
		}

		String fileDir = Util.getNowYearMonthDateStr();

		ResultData saveMetaRd = saveMeta(relTypeCode, relNum, typeCode, type2Code, fileNo, originFileName,
				fileExtTypeCode, fileExtType2Code, fileExt, fileSize, fileDir);

		int newGenFileNum = (int) saveMetaRd.getBody().get("num");

		String targetDirPath = genFileDirPath + "/" + relTypeCode + "/" + fileDir;
		java.io.File targetDir = new java.io.File(targetDirPath);

		if (targetDir.exists() == false) {
			targetDir.mkdirs();
		}

		String targetFileName = newGenFileNum + "." + fileExt;
		String targetFilePath = targetDirPath + "/" + targetFileName;

		try {
			multipartFile.transferTo(new File(targetFilePath));
		} catch (IllegalStateException | IOException e) {
			return new ResultData("F-1", "파일저장에 실패하였습니다.");
		}
		return new ResultData("S-1", "파일이 생성되었습니다.", "num", newGenFileNum, "fileRealPath", targetFilePath, "fileName",
				targetFileName, "fileInputName", fileInputName);
	}
	public void changeRelId(int id, int relId) {
		genFileDao.changeRelId(id, relId);
	}
	public GenFile getGenFile(String relTypecode, int relNum, String typeCode, String type2Code, int fileNo) {
		return genFileDao.getGenFile(relTypecode, relNum, typeCode, type2Code, fileNo);
	}

	public void changeInputFileRelIds(Map<String, Object> param, int num) {
		String genFileIdsStr = Util.ifEmpty((String) param.get("genFileIdsStr"), null);

		if (genFileIdsStr != null) {
			List<Integer> genFileIds = Util.getListDividedBy(genFileIdsStr, ",");

			// 파일이 먼저 생성된 후에, 관련 데이터가 생성되는 경우에는, file의 relId가 일단 0으로 저장된다.
			// 그것을 뒤늦게라도 이렇게 고처야 한다.
			for (int genFileId : genFileIds) {
				changeRelId(genFileId, num);
			}
		}
	}

	public ResultData saveFiles(MultipartRequest multipartRequest) {
		Map<String, MultipartFile> fileMap = multipartRequest.getFileMap();

		Map<String,ResultData> filesResultData = new HashMap<>();
		List<Integer> genFileIds = new ArrayList<>();
		
		for (String fileInputName : fileMap.keySet()) {
			MultipartFile multipartFile = fileMap.get(fileInputName);

			if (multipartFile.isEmpty() == false) {
				ResultData fileResultData = save(multipartFile, 0);
				int genFileId = (int) fileResultData.getBody().get("num");
				genFileIds.add(genFileId);
				 
				filesResultData.put(fileInputName,fileResultData);
			}
		}
		
		String genFileIdsStr = Joiner.on(",").join(genFileIds);
		
		return new ResultData("S-1" , "파일 업로드 성공", "filesResultData", filesResultData, "genFileIdsStr", genFileIdsStr);
	}

	public void deleteFiles(String relTypeCode, int relNum) {
		List<GenFile> genFiles = genFileDao.getGenFiles(relTypeCode, relNum);

		for ( GenFile genFile : genFiles ) {
			deleteFile(genFile);
		}
	}

	private void deleteFile(GenFile genFile) {
		String filePath = genFile.getFilePath(genFileDirPath);
		Util.delteFile(filePath);

		genFileDao.deleteFile(genFile.getNum());
	}
}
