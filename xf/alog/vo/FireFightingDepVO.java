package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.common.validate.StringSizeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import java.math.BigInteger;

/**
 * 消防部门
 * Created by wangyuan on 2018/1/6
 */
public class FireFightingDepVO extends BaseEntity {

    private static final long serialVersionUID = 2076513534889452645L;

    @NotBlank(message = "消防部门名称不能为空")
    @Length(message = "消防部门名称长度为1-100字符",min=1, max=100)
    private String name;

    @NotNull(message = "所属区域不能为空")
    private Long areaId;

    private String areaName;

    @NotBlank(message = "空地图位置不能为空")
    @Length(message = "空地图位置长度应为1-100字符",min=1, max=100)
    private String address;

    @NotBlank(message = "地图坐标不能为空")
    private String position;

    @Length(message = "单位介绍长度最多200字符", max=200)
    private String description;

    @Length(message = "联系电话长度应为1-15字节",min=1, max=15)
    private String telephone;

    @NotBlank(message = "部门负责人姓名不能为空")
    @Length(message = "部门负责人姓名长度应为1-20字符",min=1, max=20)
    private String liaisonOfficer;

    @NotBlank(message = "部门负责人电话不能为空")
    @Length(message = "部门负责人电话长度应为1-15字符",min=1, max=15)
    private String liaisonOfficerPhone;

    @NotBlank(message = "消防机构类别不能为空")
    @DictionaryCodeValidate(message = "消防机构类别不符合规范",dictionaryData = "01,11,12,13,21,22,23,24,25,31,32,33,34,41,51,52,53,54,61,62,63,64,99")
    private String fireServiceCode;

    private String fireServiceName;

    @NotNull(message = "管辖区域不能为空")
    private Long precinct;

    /** 上级消防部门 */
    private Long parentCenter;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getPosition() {
        return position;
    }

    public void setPosition(String position) {
        this.position = position;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getTelephone() {
        return telephone;
    }

    public void setTelephone(String telephone) {
        this.telephone = telephone;
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

    public String getFireServiceCode() {
        return fireServiceCode;
    }

    public void setFireServiceCode(String fireServiceCode) {
        this.fireServiceCode = fireServiceCode;
    }

    public Long getAreaId() {
        return areaId;
    }

    public void setAreaId(Long areaId) {
        this.areaId = areaId;
    }

    public Long getPrecinct() {
        return precinct;
    }

    public void setPrecinct(Long precinct) {
        this.precinct = precinct;
    }

    public Long getParentCenter() {
        return parentCenter;
    }

    public void setParentCenter(Long parentCenter) {
        this.parentCenter = parentCenter;
    }

    public String getAreaName() {
        return areaName;
    }

    public void setAreaName(String areaName) {
        this.areaName = areaName;
    }

    public String getFireServiceName() {
        return fireServiceName;
    }

    public void setFireServiceName(String fireServiceName) {
        this.fireServiceName = fireServiceName;
    }
}
