package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.common.validate.NumCodeValidate;
import com.gdlion.dpi.common.validate.StringSizeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import java.math.BigInteger;

/**
 * 监控中心
 * Created by wangyuan on 2018/1/6
 */
public class MonitorCenterVO extends BaseEntity {

    private static final long serialVersionUID = -3369433577813538218L;

    @NotBlank(message = "监控中心名称不能为空")
    @Length(message = "监控中心名称不能为空长度应为1-18字符",min=1, max=18)
    private String name;

    @NotNull(message = "所属区域不能为空")
    private Long areaId;

    private String areaName;

    @NotBlank(message = "地图位置不能为空")
    @Length(message = "地图位置长度应为1-100字符",min=1, max=100)
    private String address;

    @NotBlank(message = "地图坐标不能为空")
    private String position;

    @Length(message = "监控中心介绍长度最大200字符", max=200)
    private String description;

    @NotBlank(message = "联系电话不能为空")
    @Length(message = "联系电话长度应为1-15字符",min=1, max=15)
    private String telephone;

    @NotBlank(message = "中心负责人姓名不能为空")
    @Length(message = "中心负责人姓名长度应为1-20字符",min=1, max=20)
    private String chargePerson;

    @NotBlank(message = "中心负责人电话不能为空")
    @Length(message = "中心负责人电话长度应为1-15字符",min=1, max=15)
    private String chargePhone;

    @NotBlank(message = "中心级别不能为空")
    @DictionaryCodeValidate(message = "中心级别不符合规范",dictionaryData = "1,2,3,4,5,6")
    private String monitorCenterRankCode;

    private String monitorCenterRankName;

    /** 父级监控中心id */
    private Long parentCenter;

    @NumCodeValidate(message = "暂停状态值不合法",intVal="1,0")
    private Integer pauseFlag;

    public String getAreaName() {
        return areaName;
    }

    public void setAreaName(String areaName) {
        this.areaName = areaName;
    }

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

    public String getChargePerson() {
        return chargePerson;
    }

    public void setChargePerson(String chargePerson) {
        this.chargePerson = chargePerson;
    }

    public String getChargePhone() {
        return chargePhone;
    }

    public void setChargePhone(String chargePhone) {
        this.chargePhone = chargePhone;
    }

    public String getMonitorCenterRankCode() {
        return monitorCenterRankCode;
    }

    public void setMonitorCenterRankCode(String monitorCenterRankCode) {
        this.monitorCenterRankCode = monitorCenterRankCode;
    }

    public Long getParentCenter() {
        return parentCenter;
    }

    public void setParentCenter(Long parentCenter) {
        this.parentCenter = parentCenter;
    }

    public Integer getPauseFlag() {
        return pauseFlag;
    }

    public void setPauseFlag(Integer pauseFlag) {
        this.pauseFlag = pauseFlag;
    }

    public String getMonitorCenterRankName() {
        return monitorCenterRankName;
    }

    public void setMonitorCenterRankName(String monitorCenterRankName) {
        this.monitorCenterRankName = monitorCenterRankName;
    }
}
