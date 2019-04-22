package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;

/**
 * Created by wangyuan on 2018/2/1
 */
public class AgentVO extends BaseEntity{

    private static final long serialVersionUID = 7462924543834381012L;

    /** 代理商名称 */
    @NotBlank(message = "代理商名称不能为空")
    @Length(message = "代理商名称长度应为1-50字符", min = 1, max = 50)
    private String name;

    /** 负责人名称 */
    @NotBlank(message = "代理商负责人姓名不能为空")
    @Length(message = "代理商负责人姓名长度应为1-20字符", min = 1, max = 20)
    private String chargePerson;

    /** 联系电话 */
    @NotBlank(message = "代理商负责人电话不能为空")
    @Length(message = "代理商负责人电话长度应为3-15字符", min = 3, max = 15)
    private String phone;

    /** 公司地址 */
    @Length(message = "公司地址长度应为1-100字符", min = 1, max = 100)
    private String address;

    /** 所属区域 */
    @NotNull(message = "代理商所属区域不能为空")
    private Long areaId;

    /** 所属区域名称 */
    private String areaName;

    /** logo路径 */
    @NotBlank(message = "公司logo不能为空")
    private String logoPath;

    /** 系统名称 */
    @NotBlank(message = "系统名称不能为空")
    @Length(message = "系统名称长度应为1-20字符", min = 1, max = 20)
    private String systemName;

    @NotBlank(message = "代理区域不能为空")
    private String areaIds;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getChargePerson() {
        return chargePerson;
    }

    public void setChargePerson(String chargePerson) {
        this.chargePerson = chargePerson;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public Long getAreaId() {
        return areaId;
    }

    public void setAreaId(Long areaId) {
        this.areaId = areaId;
    }

    public String getAreaName() {
        return areaName;
    }

    public void setAreaName(String areaName) {
        this.areaName = areaName;
    }

    public String getLogoPath() {
        return logoPath;
    }

    public void setLogoPath(String logoPath) {
        this.logoPath = logoPath;
    }

    public String getSystemName() {
        return systemName;
    }

    public void setSystemName(String systemName) {
        this.systemName = systemName;
    }

    public String getAreaIds() {
        return areaIds;
    }

    public void setAreaIds(String areaIds) {
        this.areaIds = areaIds;
    }
}
