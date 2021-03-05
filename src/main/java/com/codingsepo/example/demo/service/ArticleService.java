package com.codingsepo.example.demo.service;

import java.util.List;

import org.springframework.stereotype.Service;

import com.codingsepo.example.demo.dto.Article;

@Service
public class ArticleService {
	
	private List<Article> articles;
	private int articlesLastNum = 2;
	
	public Article getArticle(int num) {
		
		for(Article article : articles) {
			if(article.getNum() == num) {
				return article;
			}
				
		}

		return null;
	}

	public List<Article> getArticles() {
		return articles;
	}

	public int doAdd(String regDate, String updateDate, String title, String body) {
		
		articles.add(new Article(++articlesLastNum, regDate, updateDate, title, body));
		
		return articlesLastNum;
	}

	public boolean deleteArticle(int num) {

		for (Article article : articles) {
			if (article.getNum() == num) {
				articles.remove(article);
				return true;
			}
		}
		
		return false;
	}

	public boolean doModify(int num, String updateDate, String title, String body) {
		Article selArticle = null;
		
		for (Article article : articles) {
			if(article.getNum() == num) {
				selArticle = article;
			}
		}
		
		selArticle.setUpdateDate(updateDate);
		selArticle.setTitle(title);
		selArticle.setBody(body);
		
		if(selArticle == null) {
			return false;
		}
		
		return true;
	}

}
