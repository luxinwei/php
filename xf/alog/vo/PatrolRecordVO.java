package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import java.io.Serializable;

/**
 * Created by wangyuan on 2018/1/8
 */
public class PatrolRecordVO implements Serializable{

    private static final long serialVersionUID = 3594537158856975005L;

    /**主键id*/
    private String id;

    /** 所属单位id */
    @NotNull(message = "所属单位不能为空")
    private Long depId;

    private String depName;

    /** 巡查内容 */
    @NotBlank(message = "巡查内容不能为空")
    @Length(message = "巡查内容长度应为1-200字符", min = 1, max = 200)
    private String content;

    /** 巡查点id */
    @NotNull(message = "关联测点不能为空")
    private Long patrolPointId;

    /** 巡查日期 */
    @NotNull(message = "巡查日期不能为空")
    private String patrolTime;

    /** 巡查人姓名 */
    private String patrolName;

    /** 消防安全管理人姓名 ，从业主单位中获取*/
    private String custodian;

    /** 巡查类别 字典项*/
    @NotBlank(message = "巡查类别不能为空")
    @DictionaryCodeValidate(message = "巡查类别不符合规范",dictionaryData = "1,2,3,9")
    private String patrolType;

    @NotBlank(message = "巡查结果不能为空")
    @DictionaryCodeValidate(message = "巡查结果不符合规范",dictionaryData = "1,2,9")
    private String checkResultCode;

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public Long getPatrolPointId() {
        return patrolPointId;
    }

    public void setPatrolPointId(Long patrolPointId) {
        this.patrolPointId = patrolPointId;
    }

    public String getPatrolTime() {
        return patrolTime;
    }

    public void setPatrolTime(String patrolTime) {
        this.patrolTime = patrolTime;
    }

    public String getPatrolName() {
        return patrolName;
    }

    public void setPatrolName(String patrolName) {
        this.patrolName = patrolName;
    }

    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public String getCustodian() {
        return custodian;
    }

    public void setCustodian(String custodian) {
        this.custodian = custodian;
    }

    public String getPatrolType() {
        return patrolType;
    }

    public void setPatrolType(String patrolType) {
        this.patrolType = patrolType;
    }

    public String getCheckResultCode() {
        return checkResultCode;
    }

    public void setCheckResultCode(String checkResultCode) {
        this.checkResultCode = checkResultCode;
    }
}
