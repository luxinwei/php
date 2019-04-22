package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * 用户详细信息
 * Created by zhang on 2018/1/7
 */
public class UserInfoVO extends BaseEntity {

    private static final long serialVersionUID = 5798710713771290851L;

    @NotNull(message = "关联用户表id不能为空")
    private Long userId;

    @NotBlank(message = "用户详情名称不能为空")
    private String name;

    @NotBlank(message = "用户手机号不能为空")
    private String phone;

    @NotBlank(message = "用户文化程度不能为空")
    @Length(message = "用户文化程度长度应为1-50字符",min = 1,max = 50)
    private String educationDegree;

    /** 是否受过消防培训 1:是  0:否 */
    @Length(message = "是否受过消防培训应为一个字符")
    private Integer trainingFlag;

    @Past(message = "参加消防培训时间异常")
    private Date trainingTime;

    @Length(message = "培训证书长度应为1-50",min = 1,max = 50)
    private String certificateNum;

    @Past(message = "消防培训领证时间异常")
    private Date getTime;

    /** 是否为消防引导员 1:是  0:否 */
    @NotNull(message = "是否为疏散引导员不能为空")
    private Integer evacuationGuide;

    public Long getUserId() {
        return userId;
    }

    public void setUserId(Long userId) {
        this.userId = userId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getEducationDegree() {
        return educationDegree;
    }

    public void setEducationDegree(String educationDegree) {
        this.educationDegree = educationDegree;
    }

    public Integer getTrainingFlag() {
        return trainingFlag;
    }

    public void setTrainingFlag(Integer trainingFlag) {
        this.trainingFlag = trainingFlag;
    }

    public Date getTrainingTime() {
        return trainingTime;
    }

    public void setTrainingTime(Date trainingTime) {
        this.trainingTime = trainingTime;
    }

    public String getCertificateNum() {
        return certificateNum;
    }

    public void setCertificateNum(String certificateNum) {
        this.certificateNum = certificateNum;
    }

    public Date getGetTime() {
        return getTime;
    }

    public void setGetTime(Date getTime) {
        this.getTime = getTime;
    }

    public Integer getEvacuationGuide() {
        return evacuationGuide;
    }

    public void setEvacuationGuide(Integer evacuationGuide) {
        this.evacuationGuide = evacuationGuide;
    }
}
