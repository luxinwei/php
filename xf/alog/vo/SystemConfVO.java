package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * 系统配置
 * Created by zhang on 2018/1/6
 */
public class SystemConfVO extends BaseEntity {

    private static final long serialVersionUID = 2155656617887289223L;

    @NotBlank(message = "系统配置项名称不能为空")
    @Length(message = "系统配置项名称长度应为1-20字符",min = 1,max = 20)
    private String name;

    @NotBlank(message = "系统配置项编码不能为空")
    @Length(message = "系统配置项编码长度应为1-20字符",min = 1,max = 20)
    private String code;

    @NotBlank(message = "系统配置项值不能为空")
    @Length(message = "系统配置项值长度应为1-20字符",min = 1,max = 20)
    private String value;

    @NotNull(message = "所属单位id不能为空")
    private Long depIds;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public String getValue() {
        return value;
    }

    public void setValue(String value) {
        this.value = value;
    }

    public Long getDepIds() {
        return depIds;
    }

    public void setDepIds(Long depIds) {
        this.depIds = depIds;
    }
}
