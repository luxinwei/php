package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;

/**
 * Created by wangyuan on 2018/1/28
 */
public class GridAdminVO extends BaseEntity {

    private static final long serialVersionUID = 729200040639203L;

    /** 网格管理名称 */
    @NotBlank(message = "网格管理名称不能为空")
    @Length(message = "消网格管理名称长度为1-50字符",min=1, max=50)
    private String name;

    /** 所属区域id */
    @NotNull(message = "所属区域不能为空")
    private Long areaId;

    /** 所属区域名称 */
    private String areaName;

    /** 部门接口人 */
    @NotBlank(message = "部门接口人不能为空")
    @Length(message = "部门接口人长度应为1-15字符", min = 1, max = 20)
    private String liaisonOfficer;

    /** 部门接口人电话 */
    @NotBlank(message = "部门接口人电话不能为空")
    @Length(message = "部门接口人电话长度应为3-15位", min = 3, max = 15)
    private String liaisonOfficerPhone;

    /** 管理范围坐标，英文分号分割 */
    @NotBlank(message = "管理范围坐标不能为空")
    @Length(message = "管理方位坐标长度应为10-1000", min = 10, max = 1000)
    private String scopeCoordinates;

    /** 上级单位名称 */
    @NotNull(message = "上级管理单位不能为空")
    private Long parentDep;

    /** 上级单位名称 */
    private String parentDepName;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
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

    public String getLiaisonOfficer() {
        return liaisonOfficer;
    }

    public void setLiaisonOfficer(String liaisonOfficer) {
        this.liaisonOfficer = liaisonOfficer;
    }

    public String getLiaisonOfficerPhone() {
        return liaisonOfficerPhone;
    }

    public void setLiaisonOfficerPhone(String liaisonOfficerPhone) {
        this.liaisonOfficerPhone = liaisonOfficerPhone;
    }

    public String getScopeCoordinates() {
        return scopeCoordinates;
    }

    public void setScopeCoordinates(String scopeCoordinates) {
        this.scopeCoordinates = scopeCoordinates;
    }

    public Long getParentDep() {
        return parentDep;
    }

    public void setParentDep(Long parentDep) {
        this.parentDep = parentDep;
    }

    public String getParentDepName() {
        return parentDepName;
    }

    public void setParentDepName(String parentDepName) {
        this.parentDepName = parentDepName;
    }
}
