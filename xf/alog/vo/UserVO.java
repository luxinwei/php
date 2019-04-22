package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.common.validate.NumCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * 用户信息
 * Created by zhang on 2018/1/7
 */
public class UserVO extends BaseEntity {

    private static final long serialVersionUID = -6478027052379208402L;

    @NotBlank(message = "用户姓名不能为空")
    @Length(message = "用户姓名长度应为1-20字符",min = 1,max = 20)
    private String name;

    @NotBlank(message = "用户手机号码不能为空")
    @Length(message = "用户手机号长度应为3-15字符",min = 3,max = 15)
    private String phone;

    @NotBlank(message = "用户登录密码不能为空")
    @Length(message = "用户登录密码长度应为6-50字符",min = 6,max = 50)
    private String password;

    @NotBlank(message = "单位类型")
    @Length(message = "单位类型长度应为1-30字符",min = 1,max = 30)
    private String appCode;

    @NotNull(message = "用户单位id不能为空")
    private Long depId;

    @NumCodeValidate(message = "性格不符合规范",intVal = "0,1")
    private Integer sex;

    @Length(message = "用户邮箱长度应为1-50字符",min = 1,max = 50)
    private String email;

    @Past(message = "用户出生日期异常")
    private Date birthday;

    @Length(message = "用户地址长度应为1-100字符",min = 1,max = 100)
    private String address;

    private Integer state;//状态

    private String depName; //用户单位名称

    private String logoOssPath; //用户单位logo

    private String educationDegree; //文化程度

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Integer getSex() {
        return sex;
    }

    public void setSex(Integer sex) {
        this.sex = sex;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public Date getBirthday() {
        return birthday;
    }

    public void setBirthday(Date birthday) {
        this.birthday = birthday;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getAppCode() {
        return appCode;
    }

    public void setAppCode(String appCode) {
        this.appCode = appCode;
    }

    public Integer getState() {
        return state;
    }

    public void setState(Integer state) {
        this.state = state;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }

    public String getLogoOssPath() {
        return logoOssPath;
    }

    public void setLogoOssPath(String logoOssPath) {
        this.logoOssPath = logoOssPath;
    }

    public String getEducationDegree() {
        return educationDegree;
    }

    public void setEducationDegree(String educationDegree) {
        this.educationDegree = educationDegree;
    }
}
