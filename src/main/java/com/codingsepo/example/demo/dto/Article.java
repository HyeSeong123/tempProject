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
	private String title;
	private String body;
	
	public Article(int num, String regDate, String title, String body) {
		this.num = num;
		this.regDate = regDate;
		this.updateDate = updateDate;
		this.title = title;
		this.body = body;
	}
}