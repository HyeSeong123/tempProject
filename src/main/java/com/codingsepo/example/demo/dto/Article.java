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
	private int boardNum;
	private String title;
	private String body;
	private int view;
	
	private String extra__writer;
	private String extra__board;
	private String extra__thumbImg;
}