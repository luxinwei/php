package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Past;
import java.util.Date;

/**
 * 角色
 * Created by zhang on 2018/1/7
 */
public class RoleVO extends BaseEntity {

    private static final long serialVersionUID = -6779837289564744581L;

    @NotBlank(message = "角色名称不能为空")
    @Length(message = "角色名称长度应为1-50字符",min = 1,max = 50)
    private String name;

    @Length(message = "角色描述长度应为1-100字符",min = 1,max = 100)
    private String description;

    private String appCode;

    /** 选中多个功能，英文逗号分割 */
    @NotBlank(message = "菜单id不能为空")
    private String confMenuIds;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getAppCode() {
        return appCode;
    }

    public void setAppCode(String appCode) {
        this.appCode = appCode;
    }

    public String getConfMenuIds() {
        return confMenuIds;
    }

    public void setConfMenuIds(String confMenuIds) {
        this.confMenuIds = confMenuIds;
    }
}
