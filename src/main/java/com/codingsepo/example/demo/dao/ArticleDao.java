package com.codingsepo.example.demo.dao;

import java.util.List;
import java.util.Map;

import org.apache.ibatis.annotations.Mapper;
import org.apache.ibatis.annotations.Param;

import com.codingsepo.example.demo.dto.Article;
import com.codingsepo.example.demo.dto.Board;

@Mapper
public interface ArticleDao {

	public Article getArticle(@Param("num") int num);

	public List<Article> getArticles();

	public void addArticle(Map<String, Object> param);

	public void deleteArticle(@Param("num") int num);

	public void modifyArticle(@Param("num") int num, @Param("title") String title, @Param("body") String body);

	public Article getForPrintArticle(@Param("num") int num);

	public List<Article> getForPrintArticles(@Param("boardNum") int boardNum,
			@Param("searchKeywordType") String searchKeywordType, @Param("searchKeyword") String searchKeyword,
			@Param("limitStart") int limitStart, @Param("limitTake") int limitTake);

	public Board getBoardByNum(@Param("num") int boardNum);

	public int totalCount(@Param("boardNum") int boardNum, @Param("searchKeyword") String searchKeyword,
			@Param("searchKeywordType") String searchKeywordType);

	public void increase(@Param("num") int num, @Param("view") int view);

}