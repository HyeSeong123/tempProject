package com.codingsepo.example.demo.dto;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor
public class Board {
	private int num;
	private String regDate;
	private String updateDate;
	private String name;
	private String code;
}
