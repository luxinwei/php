package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;

/**
 * 行政区划
 * Created by zhang on 2018/1/7
 */
public class AreaVO extends BaseEntity {

    private static final long serialVersionUID = -810763758996220833L;

    @NotBlank(message = "地区编号不能为空")
    @Length(message = "地区编号长度应为1-20字符",min = 1,max = 20)
    private String sid;

    @NotBlank(message = "地区名称不能为空")
    @Length(message = "地区名称长度应为1-50字符",min = 1,max = 50)
    private String name;

    /** 父id */
    private Long parentId;

    @Length(message = "父sid长度应为1-20字符",min = 1,max = 20)
    private String parentSid;

    @NotNull(message = "地区等级不能为空")
    private Integer level;

    @NotNull(message = "排序标号不能为空")
    private Integer sortNum;

    @Length(message = "标示长度应为1-50字符",min = 1,max = 50)
    private String sign;

    public String getSid() {
        return sid;
    }

    public void setSid(String sid) {
        this.sid = sid;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public Long getParentId() {
        return parentId;
    }

    public void setParentId(Long parentId) {
        this.parentId = parentId;
    }

    public String getParentSid() {
        return parentSid;
    }

    public void setParentSid(String parentSid) {
        this.parentSid = parentSid;
    }

    public Integer getLevel() {
        return level;
    }

    public void setLevel(Integer level) {
        this.level = level;
    }

    public Integer getSortNum() {
        return sortNum;
    }

    public void setSortNum(Integer sortNum) {
        this.sortNum = sortNum;
    }

    public String getSign() {
        return sign;
    }

    public void setSign(String sign) {
        this.sign = sign;
    }
}
