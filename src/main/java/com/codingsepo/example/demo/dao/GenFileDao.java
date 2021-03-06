package com.codingsepo.example.demo.dao;

import java.util.List;
import java.util.Map;

import org.apache.ibatis.annotations.Mapper;
import org.apache.ibatis.annotations.Param;

import com.codingsepo.example.demo.dto.GenFile;

@Mapper
public interface GenFileDao {

	void saveMeta(Map<String, Object> param);

	GenFile getGenFile(@Param("relTypeCode") String relTypecode, @Param("relNum") int relNum,
			@Param("typeCode") String typeCode, @Param("type2Code") String type2Code,@Param("fileNo") int fileNo);

	void changeRelId(@Param("num")int num,@Param("relNum") int relNum);

	void deleteFiles(@Param("relTypeCode") String relTypeCode,@Param("relNum") int relNum);

	List<GenFile> getGenFiles(@Param("relTypeCode") String relTypeCode,@Param("relNum") int relNum);
	
	void deleteFile(@Param("num") int num);
	
}
