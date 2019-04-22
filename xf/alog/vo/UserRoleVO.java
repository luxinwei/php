package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.NotBlank;
import org.omg.PortableInterceptor.INACTIVE;

import javax.validation.constraints.NotNull;

/**
 * 用户角色
 * Created by zhang on 2018/1/7
 */
public class UserRoleVO extends BaseEntity {

    private static final long serialVersionUID = -3290006858054902929L;

    @NotNull(message = "用户id不能为空")
    private Long userId;

    /** 多个系统英文逗号分割 */
    @NotBlank(message = "用户所属APP不能为空")
    private String appCodes;

    /** 多个角色英文逗号分割 */
    @NotNull(message = "角色id不能为空")
    private String roleIds;

    public Long getUserId() {
        return userId;
    }

    public void setUserId(Long userId) {
        this.userId = userId;
    }

    public String getRoleIds() {
        return roleIds;
    }

    public void setRoleIds(String roleIds) {
        this.roleIds = roleIds;
    }

    public String getAppCodes() {
        return appCodes;
    }

    public void setAppCodes(String appCodes) {
        this.appCodes = appCodes;
    }
}
