package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.NumCodeValidate;
import com.gdlion.dpi.domain.BaseFields;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;

/**
 * 系统菜单配置管理
 * Created by wangyuan on 2018/1/12
 */
public class SystemMenuVO extends BaseFields{

    private static final long serialVersionUID = -3157847356959504921L;

    @NotBlank(message = "菜单名称不能为空")
    @Length(message = "菜单名称长度为1-50字符", min = 1, max = 50)
    private String name;

    @Length(message = "系统编码长度为1-50字符", min = 1, max = 50)
    @NotBlank(message = "系统类型不能为空")
    private String appCode;

    /** 父级节点id */
    private Long parentId;

    /** 一级菜单对应的默认链接 */
    private Long menuId;

    /** 排序编号 */
    @NotNull(message = "排序编号不能为空")
    private Integer sortNum;

    @NotNull(message = "菜单等级不能为空")
    @NumCodeValidate(message = "菜单等级不合法",intVal = "0,1,2")
    private Integer level;

    /** 对应的功能，多个英文逗号分隔 */
    private String menuIds;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getAppCode() {
        return appCode;
    }

    public void setAppCode(String appCode) {
        this.appCode = appCode;
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

    public Integer getLevel() {
        return level;
    }

    public void setLevel(Integer level) {
        this.level = level;
    }

    public void setSortNum(Integer sortNum) {
        this.sortNum = sortNum;
    }

    public Long getMenuId() {
        return menuId;
    }

    public void setMenuId(Long menuId) {
        this.menuId = menuId;
    }

    public String getMenuIds() {
        return menuIds;
    }

    public void setMenuIds(String menuIds) {
        this.menuIds = menuIds;
    }
}
