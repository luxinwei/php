package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.util.Date;

/**
 * 消防法规
 * Created by zhang on 2018/1/6
 */
public class FireCodeVO extends BaseEntity {

    private static final long serialVersionUID = -4286579363391735190L;

    @NotBlank(message = "消防法规名称不能为空")
    @Length(message = "法规名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "消防法规类别不能为空")
    @DictionaryCodeValidate(message = "消防法规类型不符合规范", dictionaryData = "11,21,22,31,32,41,42,43,51,52,53,54,61,62,63,64,99")
    private String fireLawCode;

    private String fireLawName;

    @NotBlank(message = "颁发机关不能为空")
    @Length(message = "颁发机长度应为1-100字符",min = 1,max = 100)
    private String promulgateOffice;

    @NotBlank(message = "批准机关不能为空")
    @Length(message = "批准机关长度应为1-100字符",min = 1,max = 100)
    private String approveOffice;

    @NotBlank(message = "颁布文号不能为空")
    @Length(message = "颁布文号长度应为1-50字符",min = 1,max = 50)
    private String promulgateNo;

    @Past(message = "颁布日期异常")
    @NotNull(message = "颁发日期不能为空")
    private Date promulgateDate;

    @NotNull(message = "执行日期不能为空")
    private Date implementDate;

    @NotBlank(message = "消防法规内容不能为空")
    @Length(message = "消防法规内容长度应为1-1000字符",min = 1,max = 1000)
    private String content;

    @Length(message = "消防法规输入人姓名长度应为1-20字符",min = 1,max = 20)
    private String createUser;

    @DictionaryCodeValidate(message = "数据状态不符合规范", dictionaryData = "0,1,2,3,4")
    private String dataStateCode;

    private String dataStateName;

    private Date createTime;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPromulgateOffice() {
        return promulgateOffice;
    }

    public void setPromulgateOffice(String promulgateOffice) {
        this.promulgateOffice = promulgateOffice;
    }

    public String getApproveOffice() {
        return approveOffice;
    }

    public void setApproveOffice(String approveOffice) {
        this.approveOffice = approveOffice;
    }

    public String getPromulgateNo() {
        return promulgateNo;
    }

    public void setPromulgateNo(String promulgateNo) {
        this.promulgateNo = promulgateNo;
    }

    public Date getPromulgateDate() {
        return promulgateDate;
    }

    public void setPromulgateDate(Date promulgateDate) {
        this.promulgateDate = promulgateDate;
    }

    public Date getImplementDate() {
        return implementDate;
    }

    public void setImplementDate(Date implementDate) {
        this.implementDate = implementDate;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getCreateUser() {
        return createUser;
    }

    public void setCreateUser(String createUser) {
        this.createUser = createUser;
    }

    public String getFireLawCode() {
        return fireLawCode;
    }

    public void setFireLawCode(String fireLawCode) {
        this.fireLawCode = fireLawCode;
    }

    public String getDataStateCode() {
        return dataStateCode;
    }

    public void setDataStateCode(String dataStateCode) {
        this.dataStateCode = dataStateCode;
    }

    public Date getCreateTime() {
        return createTime;
    }

    public void setCreateTime(Date createTime) {
        this.createTime = createTime;
    }

    public String getFireLawName() {
        return fireLawName;
    }

    public void setFireLawName(String fireLawName) {
        this.fireLawName = fireLawName;
    }

    public String getDataStateName() {
        return dataStateName;
    }

    public void setDataStateName(String dataStateName) {
        this.dataStateName = dataStateName;
    }
}

