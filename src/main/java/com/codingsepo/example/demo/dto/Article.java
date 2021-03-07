package com.codingsepo.example.demo.dto;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@NoArgsConstructor
@AllArgsConstructor
@Data
public class Article {
	private int num;
	private String regDate;
	private String updateDate;
	private int memberNum;
	private String title;
	private String body;
	
	private String extra__writer;
}