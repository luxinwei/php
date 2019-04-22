package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import java.util.Date;

/**
 * 消防常识
 * Created by zhang on 2018/1/7
 */
public class CommonSenseVO extends BaseEntity {

    private static final long serialVersionUID = -6111835504814128702L;

    @NotBlank(message = "消防常识名称不能为空")
    @Length(message = "消防常识名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "消防常识内容不能为空")
    @Length(message = "消防常识内容长度应为1-1000字符",min = 1,max = 1000)
    private String content;

    @Length(message = "输入人姓名长度应为1-20字符",min = 1,max = 20)
    private String createUser;

    @DictionaryCodeValidate(message = "消防常识状态不符合规范",dictionaryData = "0,1,2,3,4")
    private String dataStateCode;

    private String dataStateName;

    /** 输入日期 */
    private Date createTime;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
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
