package com.codingsepo.example.demo.dao;

import java.util.List;
import java.util.Map;

import org.apache.ibatis.annotations.Mapper;
import org.apache.ibatis.annotations.Param;

import com.codingsepo.example.demo.dto.Article;

@Mapper
public interface ArticleDao {

	public Article getArticle(@Param("num") int num);

	public List<Article> getArticles(@Param("searchKeywordType") String searchKeywordType,@Param("searchKeyword") String searchKeyword);

	public void addArticle(Map<String, Object> param);

	public void deleteArticle(@Param("num") int num);

	public void modifyArticle(@Param("num") int num,@Param("title") String title,@Param("body") String body);

	public Article getForPrintArticle(@Param("num") int num);

	public List<Article> getForPrintArticles(@Param("searchKeywordType")String searchKeywordType,@Param("searchKeyword") String searchKeyword);
	
}