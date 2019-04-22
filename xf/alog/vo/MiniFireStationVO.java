package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Min;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * 微型消防站管理
 * Created by zhang on 2018/1/8
 */
public class MiniFireStationVO extends BaseEntity {

    private static final long serialVersionUID = 4556182116019327780L;

    @NotNull(message = "所属单位id不能为空")
    private Long depId;

    @NotBlank(message = "名称不能为空")
    @Length(message = "名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "编号不能为空")
    @Length(message = "编号长度应为1-100字符",min = 1,max = 100)
    private String code;

    @NotBlank(message = "地图位置不能为空")
    @Length(message = "地图位置长度应为1-100字符",min = 1,max = 100)
    private String address;

    @NotBlank(message = "地图坐标不能为空")
    @Length(message = "地图坐标长度应为1-20字符",min = 1,max = 20)
    private String position;

    @NotBlank(message = "负责人姓名不能为空")
    @Length(message = "负责人姓名长度应为1-20字符",min = 1,max = 20)
    private String chargePerson;

    @NotBlank(message = "负责人电话不能为空")
    @Length(message = "负责人电话长度应为3-15字符",min = 3,max = 15)
    private String phone;

    @NotBlank(message = "值班电话不能为空")
    @Length(message = "值班电话长度应为3-15字符",min = 3,max = 15)
    private String dutyPhone;

    private Integer personCount;

    private String depName;//所属业主单位名称

    /** 人员选中多个，用于英文逗号分割 */
    @NotBlank(message = "微型消防站关联人员不能为空")
    private String userIds;

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

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

    public String getDutyPhone() {
        return dutyPhone;
    }

    public void setDutyPhone(String dutyPhone) {
        this.dutyPhone = dutyPhone;
    }

    public Integer getPersonCount() {
        return personCount;
    }

    public void setPersonCount(Integer personCount) {
        this.personCount = personCount;
    }

    public String getUserIds() {
        return userIds;
    }

    public void setUserIds(String userIds) {
        this.userIds = userIds;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }
}
