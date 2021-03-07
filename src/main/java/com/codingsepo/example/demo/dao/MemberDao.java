package com.codingsepo.example.demo.dao;

import java.util.Map;

import org.apache.ibatis.annotations.Mapper;
import org.apache.ibatis.annotations.Param;

import com.codingsepo.example.demo.dto.Member;

@Mapper
public interface MemberDao {

	public void join(Map<String, Object> param);

	public Member getMemberByLoginId(@Param("loginId") String loginId);

	public Member getMemberByNum(@Param("num")int loginedMemberNum);

    void modifyMember(Map<String, Object> param);

}
