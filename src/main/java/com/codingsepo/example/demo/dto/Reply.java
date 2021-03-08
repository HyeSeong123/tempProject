package com.codingsepo.example.demo.dto;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor

public class Reply {
	private int num;
	private String regDate;
	private String updateDate;
	private int memberNum;
	private int relNum;
	private String relTypeCode;
	private String body;
	
	private String extra__writer;
}
