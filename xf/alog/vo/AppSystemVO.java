package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import java.util.Date;

/**
 * 应用管理
 * Created by zhang on 2018/1/7
 */
public class AppSystemVO extends BaseEntity {

    private static final long serialVersionUID = 4985255670837596589L;

    @NotBlank(message = "应用编号不能为空")
    @Length(message = "应用编号长度应为1-20字符",min = 1,max = 20)
    private String code;

    @NotBlank(message = "应用名称不能为空")
    @Length(message = "应用名后才能长度应为1-50字符",min = 1,max = 50)
    private String name;

    @Length(message = "版本号长度应为1-10字符",min = 1,max = 10)
    private String version;

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getVersion() {
        return version;
    }

    public void setVersion(String version) {
        this.version = version;
    }
}
