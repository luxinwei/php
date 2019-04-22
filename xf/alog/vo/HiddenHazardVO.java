package com.gdlion.dpi.domain.vo;

import java.io.Serializable;

/**
 * Created by wangyuan on 2018/2/3
 */
public class HiddenHazardVO implements Serializable {

    private static final long serialVersionUID = 5905666741743595124L;

    /** uuid */
    private String id;

    private Long depId;

    /** 单位内容 */
    private String depName;

    /** 隐患内容 */
    private String content;

    /** 巡查点 */
    private Long patrolPointId;

    /** 巡查点名称 */
    private String patrolPointName;

    /** 发现时间 */
    private String discoveryTime;

    /** 治理状况 0:未处理  1:处理中  2:已处理*/
    private String state;

    /** 治理完成时间 */
    private String finishTime;

    /** 治理人姓名 */
    private String processor;

    /** 消防安全管理人姓名 */
    private String custodianName;

    private String createTime;

    private String updateTime;

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

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

    public String getPatrolPointName() {
        return patrolPointName;
    }

    public void setPatrolPointName(String patrolPointName) {
        this.patrolPointName = patrolPointName;
    }

    public String getDiscoveryTime() {
        return discoveryTime;
    }

    public void setDiscoveryTime(String discoveryTime) {
        this.discoveryTime = discoveryTime;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getFinishTime() {
        return finishTime;
    }

    public void setFinishTime(String finishTime) {
        this.finishTime = finishTime;
    }

    public String getProcessor() {
        return processor;
    }

    public void setProcessor(String processor) {
        this.processor = processor;
    }

    public String getCustodianName() {
        return custodianName;
    }

    public void setCustodianName(String custodianName) {
        this.custodianName = custodianName;
    }

    public String getCreateTime() {
        return createTime;
    }

    public void setCreateTime(String createTime) {
        this.createTime = createTime;
    }

    public String getUpdateTime() {
        return updateTime;
    }

    public void setUpdateTime(String updateTime) {
        this.updateTime = updateTime;
    }
}
