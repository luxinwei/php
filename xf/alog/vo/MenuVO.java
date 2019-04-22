package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;

/**
 * 功能菜单
 * Created by zhang on 2018/1/7
 */
public class MenuVO extends BaseEntity {

    private static final long serialVersionUID = 4277646530773838625L;

    @NotBlank(message = "菜单名称不能为空")
    @Length(message = "菜单名称长度应为1-50字符",min = 1,max = 50)
    private String name;

    @Length(message = "菜单链接长度应为1-50字符",min = 1,max = 50)
    private String url;

    @Length(message = "请求方式长度应为1-10字符",min = 1,max = 10)
    private String requestMethod;

    /** 作用范围，1：功能链接  2：全局功能，不用分配就有 */
    private String scope;

    /** 父节点id */
    private Long parentId;

    @NotNull(message = "排序标号不能为空")
    private Integer sortNum;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getUrl() {
        return url;
    }

    public void setUrl(String url) {
        this.url = url;
    }

    public String getRequestMethod() {
        return requestMethod;
    }

    public void setRequestMethod(String requestMethod) {
        this.requestMethod = requestMethod;
    }

    public String getScope() {
        return scope;
    }

    public void setScope(String scope) {
        this.scope = scope;
    }

    public Long getParentId() {
        return parentId;
    }

    public void setParentId(Long parentId) {
        this.parentId = parentId;
    }

    public Integer getSortNum() {
        return sortNum;
    }

    public void setSortNum(Integer sortNum) {
        this.sortNum = sortNum;
    }
}
