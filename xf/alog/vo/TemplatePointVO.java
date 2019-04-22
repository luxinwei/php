package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;

/**
 * 模板测点
 *Created by zhang on 2018/1/19
 */
public class TemplatePointVO extends BaseEntity {

    private static final long serialVersionUID = -5602823341847005160L;

    @NotNull(message = "装置模板id不能为空")
    private Long terTemId;

    @NotBlank(message = "测点名称不能为空")
    @Length(message = "测点名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "测点类型不能为空")
    @Length(message = "测点类型长度应为1-100字节",min = 1,max = 100)
    private String type;

    @Length(message = "点小类长度应为1-50字节",min = 1,max = 50)
    private String pSmall;

    @Length(message = "点号长度应为1-50字节",min = 1,max = 50)
    private String pNum;

    @Length(message = "数据单位长度应为1-100字节",min = 1,max = 100)
    private String dataUnit;

    @NotNull(message = "删除状态不能为空")
    private Long delFlag;

    public Long getTerTemId() {
        return terTemId;
    }

    public void setTerTemId(Long terTemId) {
        this.terTemId = terTemId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getpSmall() {
        return pSmall;
    }

    public void setpSmall(String pSmall) {
        this.pSmall = pSmall;
    }

    public String getpNum() {
        return pNum;
    }

    public void setpNum(String pNum) {
        this.pNum = pNum;
    }

    public String getDataUnit() {
        return dataUnit;
    }

    public void setDataUnit(String dataUnit) {
        this.dataUnit = dataUnit;
    }

    public Long getDelFlag() {
        return delFlag;
    }

    public void setDelFlag(Long delFlag) {
        this.delFlag = delFlag;
    }
}
