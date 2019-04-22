package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;

/**
 * 主机
 *Created by zhang on 2018/1/19
 */
public class MainframeVO extends BaseEntity {

    private static final long serialVersionUID = 1229753767089599841L;

    @NotBlank(message = "主机名称不能为空")
    @Length(message = "主机名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "主机sid不能为空")
    @Length(message = "主机sid长度应为1-100字符",min = 1,max = 100)
    private String sid;

    @NotNull(message = "通讯模组id不能为空")
    private Long moduleId;

    @Length(message = "生产产商的长度应为1-100字符",min = 1,max = 100)
    private String manufacturer;

    @Length(message = "型号的长度应为1-100字符",min = 1,max = 100)
    private String model;

    @NotNull(message = "编号不能为空")
    private Long number;

    @Length(message = "描述长度应为1-200字符",min = 1,max = 200)
    private String description;

    private Integer delFlag;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getSid() {
        return sid;
    }

    public void setSid(String sid) {
        this.sid = sid;
    }

    public Long getModuleId() {
        return moduleId;
    }

    public void setModuleId(Long moduleId) {
        this.moduleId = moduleId;
    }

    public String getManufacturer() {
        return manufacturer;
    }

    public void setManufacturer(String manufacturer) {
        this.manufacturer = manufacturer;
    }

    public String getModel() {
        return model;
    }

    public void setModel(String model) {
        this.model = model;
    }

    public Long getNumber() {
        return number;
    }

    public void setNumber(Long number) {
        this.number = number;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public Integer getDelFlag() {
        return delFlag;
    }

    public void setDelFlag(Integer delFlag) {
        this.delFlag = delFlag;
    }
}
