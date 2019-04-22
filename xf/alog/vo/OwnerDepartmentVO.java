package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.*;
import java.math.BigDecimal;
import java.util.Date;

/**
 * 业主单位
 * Created by wangyuan on 2018/1/6
 */
public class OwnerDepartmentVO extends BaseEntity {

    private static final long serialVersionUID = -5077760501636165928L;

    @NotBlank(message = "业主单位名称不能为空")
    @Length(message = "业主单位名称不能为空长度最大100字节", max=100)
    private String name;

    @NotBlank(message = "组织机构代码不能为空")
    @Length(message = "组织机构代码空长度应为6-100字节",min = 6, max=20)
    private String organizationCode;

    @NotBlank(message = "业主单位类别不能为空")
    @DictionaryCodeValidate(message = "单位类别不符合规范",dictionaryData = "01,02,03,04,05,06,07,08,09,10,11,12,99")
    private String orgTypeCode;

    private String orgTypeName;

    /** 职工人数 */
    @Digits(message = "职工人数异常",integer = 5, fraction = 0)
    private Integer employeeAmount;

    /** 成立时间 */
    @Past(message = "成立时间异常")
    private Date foundingTime;

    /** 业主管理平台修改时不能为空 */
    @NotNull(message = "所属区域不能为空")
    private Long areaId;

    private String areaName;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "地图位置长度应为1-100字节",min=1, max=100)
    private String address;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "地图坐标长度最多20字节", max=20)
    private String position;

    @Length(message = "业主单位介绍长度最多100字节", max=100)
    private String description;

    @Length(message = "邮政编码长度最多10字节", max=100)
    private String postalCode;

    /** 业主管理平台修改时不能为空 消防单位*/
    private Long parentDep;

    private String parentDepName;

    @DictionaryCodeValidate(message = "经济所有制类别不符合规范",dictionaryData = "1,2,3,4,5,6")
    private String economicSystemCode;

    private String economicSystemName;

    @Digits(message = "固定资产值不符合要求",integer = 8, fraction = 2)
    private BigDecimal fixedAssets;

    @Digits(message = "单位占地面积值不符合要求",integer = 8, fraction = 2)
    private BigDecimal floorSpace;

    @Digits(message = "总建筑面积值不符合要求",integer = 8, fraction = 2)
    private BigDecimal overallFloorage;

    @NotBlank(message = "监管级别不能为空")
    @DictionaryCodeValidate(message = "监管级别类别不符合规范",dictionaryData = "0,1,2,3")
    private String supervisionLevelCode;

    private String supervisionLevelName;

    /** 单位所属监控中心 */
    @NotNull(message = "所属监控中心不能为空")
    private Long affiliatedCenter;

    private String affiliatedCenterName;

    /** 联网状态 */
    private Integer onlineState;

    @NotBlank(message = "消防安全责任人姓名不能为空")
    @Length(message = "消防安全责任人姓名长度应为3-50字符",min = 1, max=50)
    private String chargePersonName;

    @NotBlank(message = "消防安全责任人身份证号不能为空")
    @Length(message = "消防安全责任人身份证号长度应为18字符",min = 18, max=18)
    private String chargePersonId;

    @NotBlank(message = "消防安全责任人电话不能为空")
    @Length(message = "消防安全责任人电话长度应为3-15字符",min = 3, max=15)
    private String chargePersonTel;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "消防安全管理人姓名长度应为1-50字符",min = 1, max=50)
    private String custodianName;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "消防安全管理人身份证号长度应为18字符",min = 18, max=18)
    private String custodianId;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "消防安全管理人电话长度应为1-15字符",min = 3, max=15)
    private String custodianTel;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "专兼职消防管理人姓名长度应为1-50字符",min = 1, max=50)
    private String fireCustodianName;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "专兼职消防管理人身份证号长度应为18字符",min = 18, max=18)
    private String fireCustodianId;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "专兼职消防管理人电话长度应为1-15字符",min = 1, max=15)
    private String fireCustodianTel;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "法人代表姓名长度应为1-50字符",min = 1, max=50)
    private String legalPersonName;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "法人代表身份证号长度应为18字符",min = 18, max=18)
    private String legalPersonId;

    /** 业主管理平台修改时不能为空 */
    @Length(message = "法人代表电话长度应为1-15字符",min = 1, max=15)
    private String legalPersonTel;

    /** 单位总平面图对应的base64字符串 */
    private String file;

    /** 上传文件名字 */
    private String fileName;

    /** 消防管辖，多选，多个英文逗号拼接 */
    private String precinctDep;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getOrganizationCode() {
        return organizationCode;
    }

    public void setOrganizationCode(String organizationCode) {
        this.organizationCode = organizationCode;
    }

    public String getOrgTypeCode() {
        return orgTypeCode;
    }

    public void setOrgTypeCode(String orgTypeCode) {
        this.orgTypeCode = orgTypeCode;
    }

    public Integer getEmployeeAmount() {
        return employeeAmount;
    }

    public void setEmployeeAmount(Integer employeeAmount) {
        this.employeeAmount = employeeAmount;
    }

    public Date getFoundingTime() {
        return foundingTime;
    }

    public void setFoundingTime(Date foundingTime) {
        this.foundingTime = foundingTime;
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

    public String getPostalCode() {
        return postalCode;
    }

    public void setPostalCode(String postalCode) {
        this.postalCode = postalCode;
    }

    public Long getParentDep() {
        return parentDep;
    }

    public void setParentDep(Long parentDep) {
        this.parentDep = parentDep;
    }

    public String getEconomicSystemCode() {
        return economicSystemCode;
    }

    public void setEconomicSystemCode(String economicSystemCode) {
        this.economicSystemCode = economicSystemCode;
    }

    public BigDecimal getFixedAssets() {
        return fixedAssets;
    }

    public void setFixedAssets(BigDecimal fixedAssets) {
        this.fixedAssets = fixedAssets;
    }

    public BigDecimal getOverallFloorage() {
        return overallFloorage;
    }

    public void setOverallFloorage(BigDecimal overallFloorage) {
        this.overallFloorage = overallFloorage;
    }

    public String getSupervisionLevelCode() {
        return supervisionLevelCode;
    }

    public void setSupervisionLevelCode(String supervisionLevelCode) {
        this.supervisionLevelCode = supervisionLevelCode;
    }

    public BigDecimal getFloorSpace() {
        return floorSpace;
    }

    public void setFloorSpace(BigDecimal floorSpace) {
        this.floorSpace = floorSpace;
    }

    public Long getAffiliatedCenter() {
        return affiliatedCenter;
    }

    public void setAffiliatedCenter(Long affiliatedCenter) {
        this.affiliatedCenter = affiliatedCenter;
    }

    public Integer getOnlineState() {
        return onlineState;
    }

    public void setOnlineState(Integer onlineState) {
        this.onlineState = onlineState;
    }

    public String getChargePersonName() {
        return chargePersonName;
    }

    public void setChargePersonName(String chargePersonName) {
        this.chargePersonName = chargePersonName;
    }

    public String getChargePersonId() {
        return chargePersonId;
    }

    public void setChargePersonId(String chargePersonId) {
        this.chargePersonId = chargePersonId;
    }

    public String getChargePersonTel() {
        return chargePersonTel;
    }

    public void setChargePersonTel(String chargePersonTel) {
        this.chargePersonTel = chargePersonTel;
    }

    public String getCustodianName() {
        return custodianName;
    }

    public void setCustodianName(String custodianName) {
        this.custodianName = custodianName;
    }

    public String getCustodianId() {
        return custodianId;
    }

    public void setCustodianId(String custodianId) {
        this.custodianId = custodianId;
    }

    public String getCustodianTel() {
        return custodianTel;
    }

    public void setCustodianTel(String custodianTel) {
        this.custodianTel = custodianTel;
    }

    public String getFireCustodianName() {
        return fireCustodianName;
    }

    public void setFireCustodianName(String fireCustodianName) {
        this.fireCustodianName = fireCustodianName;
    }

    public String getFireCustodianId() {
        return fireCustodianId;
    }

    public void setFireCustodianId(String fireCustodianId) {
        this.fireCustodianId = fireCustodianId;
    }

    public String getFireCustodianTel() {
        return fireCustodianTel;
    }

    public void setFireCustodianTel(String fireCustodianTel) {
        this.fireCustodianTel = fireCustodianTel;
    }

    public String getLegalPersonName() {
        return legalPersonName;
    }

    public void setLegalPersonName(String legalPersonName) {
        this.legalPersonName = legalPersonName;
    }

    public String getLegalPersonId() {
        return legalPersonId;
    }

    public void setLegalPersonId(String legalPersonId) {
        this.legalPersonId = legalPersonId;
    }

    public String getLegalPersonTel() {
        return legalPersonTel;
    }

    public void setLegalPersonTel(String legalPersonTel) {
        this.legalPersonTel = legalPersonTel;
    }

    public String getFile() {
        return file;
    }

    public void setFile(String file) {
        this.file = file;
    }

    public String getFileName() {
        return fileName;
    }

    public void setFileName(String fileName) {
        this.fileName = fileName;
    }

    public String getPrecinctDep() {
        return precinctDep;
    }

    public void setPrecinctDep(String precinctDep) {
        this.precinctDep = precinctDep;
    }

    public String getAreaName() {
        return areaName;
    }

    public void setAreaName(String areaName) {
        this.areaName = areaName;
    }

    public String getOrgTypeName() {
        return orgTypeName;
    }

    public void setOrgTypeName(String orgTypeName) {
        this.orgTypeName = orgTypeName;
    }

    public String getEconomicSystemName() {
        return economicSystemName;
    }

    public void setEconomicSystemName(String economicSystemName) {
        this.economicSystemName = economicSystemName;
    }

    public String getSupervisionLevelName() {
        return supervisionLevelName;
    }

    public void setSupervisionLevelName(String supervisionLevelName) {
        this.supervisionLevelName = supervisionLevelName;
    }

    public String getParentDepName() {
        return parentDepName;
    }

    public void setParentDepName(String parentDepName) {
        this.parentDepName = parentDepName;
    }

    public String getAffiliatedCenterName() {
        return affiliatedCenterName;
    }

    public void setAffiliatedCenterName(String affiliatedCenterName) {
        this.affiliatedCenterName = affiliatedCenterName;
    }
}
