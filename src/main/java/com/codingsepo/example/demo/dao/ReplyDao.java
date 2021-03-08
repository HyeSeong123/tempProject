package com.codingsepo.example.demo.dao;

import java.util.List;
import java.util.Map;

import org.apache.ibatis.annotations.Mapper;
import org.apache.ibatis.annotations.Param;

import com.codingsepo.example.demo.dto.Reply;

@Mapper
public interface ReplyDao {

	List<Reply> getForPrintReplies(@Param("relNum") Integer relNum,@Param("relTypeCode") String relTypeCode);

	Reply getReply(@Param("num") int num);

	void deleteReply(@Param("num") int num);

	void addReply(Map<String, Object> param);

	void modifyReply(@Param("num") int num, @Param("body") String body);

}
