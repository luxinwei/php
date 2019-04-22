package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * 测点
 * Created by zhang on 2018/1/8
 */
public class MeasurePointVO extends BaseEntity {

    private static final long serialVersionUID = -1764443510415960642L;

    @NotBlank(message = "唯一标示不能为空")
    @Length(message = "唯一标示长度应为1-20字符",min = 1,max = 20)
    private String sid;

    @NotNull(message = "所属部件不能为空")
    private Long partId;

    @NotBlank(message = "测点名称不能为空")
    @Length(message = "测点名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    //TODO 添加字典项
    @DictionaryCodeValidate(message = "测点类型不合法",dictionaryData = "10100,10101,10102,10103,10104,10105,10201,10202,10203,10204,10301,10302" +
            ",10303,10304,10305,10306,10307,10401,10402,10403,10404,10501,10502,10503,10504,10601,10602,10603,10604,10700,10800,10801,10802,10803" +
            ",10901,11001,11101,11102,20100,20200,20300,20400,30101,30102,30201,40000,109,100,203,204,205,302,304,401,502")
    private String pointTypeCode;

    private String pointTypeName;

    @NotNull(message = "所属单位id不为空")
    private Long depId;

    /** 是否显示 */
    private Integer displayFlag;

    private String depName;//所属业主单位名称

    private String partName;//所属部件名称

    @Length(message = "状态长度应为1-50字符",min = 1,max = 50)
    /*@DictionaryCodeValidate*/
    private String state;//0：离线，1：在线

    /** 排序字段 */
    private Integer sortNum;

    private Integer displayIcon; //是否显示曲线（0：不显示，1：显示）

    private String pointValue;// 测点值

    private String dataUnit;//数据单位

    private String pSmall;//点小类

    private String pNum;//点号

    public String getSid() {
        return sid;
    }

    public void setSid(String sid) {
        this.sid = sid;
    }

    public Long getPartId() {
        return partId;
    }

    public void setPartId(Long partId) {
        this.partId = partId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPointTypeCode() {
        return pointTypeCode;
    }

    public void setPointTypeCode(String pointTypeCode) {
        this.pointTypeCode = pointTypeCode;
    }

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Integer getDisplayFlag() {
        return displayFlag;
    }

    public void setDisplayFlag(Integer displayFlag) {
        this.displayFlag = displayFlag;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public Integer getSortNum() {
        return sortNum;
    }

    public void setSortNum(Integer sortNum) {
        this.sortNum = sortNum;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }

    public String getPartName() {
        return partName;
    }

    public void setPartName(String partName) {
        this.partName = partName;
    }

    public String getPointTypeName() {
        return pointTypeName;
    }

    public void setPointTypeName(String pointTypeName) {
        this.pointTypeName = pointTypeName;
    }

    public Integer getDisplayIcon() {
        return displayIcon;
    }

    public void setDisplayIcon(Integer displayIcon) {
        this.displayIcon = displayIcon;
    }

    public String getPointValue() {
        return pointValue;
    }

    public void setPointValue(String pointValue) {
        this.pointValue = pointValue;
    }

    public String getDataUnit() {
        return dataUnit;
    }

    public void setDataUnit(String dataUnit) {
        this.dataUnit = dataUnit;
    }

    public String getpSmall() {
        return pSmall;
    }

    public void setpSmall(String pSmall) {
        this.pSmall = pSmall;
    }

    public String getpNum() {
        return pNum;
    }

    public void setpNum(String pNum) {
        this.pNum = pNum;
    }
}
