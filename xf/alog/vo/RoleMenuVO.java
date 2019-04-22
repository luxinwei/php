package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.NotBlank;

import java.math.BigInteger;

/**
 * 角色功能关联
 * Created by zhang on 2018/1/7
 */
public class RoleMenuVO extends BaseEntity {

    private static final long serialVersionUID = -3619225197099037488L;

    @NotBlank(message = "角色id不能为空")
    private Long roleId;

    /** 菜单名称 */
    private String menuName;

    /** 菜单id */
    private Long menuId;

    /** 菜单父id */
    private Long parentId;

    /** 接口名称 */
    private String methodName;

    /** 接口uri */
    private String url;

    /** 接口请求方式 */
    private String requestMethod;

    /** 选中多个功能，英文逗号分割 */
    @NotBlank(message = "菜单id不能为空")
    private String confMenuIds;

    public Long getRoleId() {
        return roleId;
    }

    public void setRoleId(Long roleId) {
        this.roleId = roleId;
    }

    public String getMenuName() {
        return menuName;
    }

    public void setMenuName(String menuName) {
        this.menuName = menuName;
    }

    public Long getMenuId() {
        return menuId;
    }

    public void setMenuId(Long menuId) {
        this.menuId = menuId;
    }

    public Long getParentId() {
        return parentId;
    }

    public void setParentId(Long parentId) {
        this.parentId = parentId;
    }

    public String getMethodName() {
        return methodName;
    }

    public void setMethodName(String methodName) {
        this.methodName = methodName;
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

    public String getConfMenuIds() {
        return confMenuIds;
    }

    public void setConfMenuIds(String confMenuIds) {
        this.confMenuIds = confMenuIds;
    }
}
