package com.codingsepo.example.demo.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.multipart.MultipartRequest;

import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.service.GenFileService;

@Controller
public class CommonGenFileController {
	@Autowired
	private GenFileService genFileService;
	
	@RequestMapping("/common/genFile/doUpload")
	@ResponseBody
	public ResultData doUpload(MultipartRequest multipartRequest) {
		
		return genFileService.saveFiles(multipartRequest);
	}
}
