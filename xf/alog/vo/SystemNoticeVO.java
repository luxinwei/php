package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.util.Date;

/**
 * 系统公告
 * Created by zhang on 2018/1/7
 */
public class SystemNoticeVO extends BaseEntity {

    private static final long serialVersionUID = -1959608187737202097L;

    @NotBlank(message = "系统公告不能为空")
    @Length(message = "系统公告长度应为1-1000字符",min = 1,max = 1000)
    private String content;

    @NotBlank(message = "公告范围不能为空")
    @DictionaryCodeValidate(message = "公告范围不符合规范", dictionaryData = "1,2,3")
    private String bulletinAreaCode;

    /** 保存公司类型或者公司对应的id多个英文逗号分割 */
    @NotBlank(message = "公告范围值不能为空")
    @Length(message = "公告范围值长度应为1-200字符",min = 1,max = 200)
    private String scopeValue;

    @Length(message = "输入人姓名长度应为1-50字符",min = 1,max = 20)
    private String createUser;

    /**公告状态默认保存*/
    @DictionaryCodeValidate(message = "公告状态不能为空", dictionaryData = "0,1,2,3,4")
    private String dataStateCode;

    private String dataStateName;

    private Date createTime;

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getBulletinAreaCode() {
        return bulletinAreaCode;
    }

    public void setBulletinAreaCode(String bulletinAreaCode) {
        this.bulletinAreaCode = bulletinAreaCode;
    }

    public String getScopeValue() {
        return scopeValue;
    }

    public void setScopeValue(String scopeValue) {
        this.scopeValue = scopeValue;
    }

    public String getCreateUser() {
        return createUser;
    }

    public void setCreateUser(String createUser) {
        this.createUser = createUser;
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

    public String getDataStateName() {
        return dataStateName;
    }

    public void setDataStateName(String dataStateName) {
        this.dataStateName = dataStateName;
    }
}
