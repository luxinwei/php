package com.gdlion.dpi.domain.vo.monitor;

import com.gdlion.dpi.domain.BaseEntity;
import java.util.Date;

/**
 * 火灾自动报警信息VO
 * Created by zhang 2018/02/03
 */
public class AlarmMsgVO extends BaseEntity {

    private static final long serialVersionUID = 5750705093737096607L;

    /** 设施部件id */
    private Long tId;

    /** mongodb中的id */
    private String eId;

    /** 单位id */
    private Long cid;

    /** 创建时间 */
    private String cTime;

    /** 接收时间 */
    private String rRime;

    /** 报警类型 */
    private String type;

    /** 报警内容 */
    private String content;

    /** 所属建筑物名称 */
    private String buildName;

    /** 所属重点部位名称 */
    private String impName;

    /** 所属设施名称 */
    private String deviceName;

    /** 是否误报 */
    private boolean error;

    /** 当前状态 */
    private String state;

    /** 处理是时间 */
    private String dTime;

    /** 处理结果 */
    private String result;

    public String geteId() {
        return eId;
    }

    public void seteId(String eId) {
        this.eId = eId;
    }

    public void settId(Long tId) {
        this.tId = tId;
    }

    public void setCid(Long cid) {
        this.cid = cid;
    }

    public Long gettId() {
        return tId;
    }

    public Long getCid() {
        return cid;
    }

    public void setcTime(String cTime) {
        this.cTime = cTime;
    }

    public String getrRime() {
        return rRime;
    }

    public void setrRime(String rRime) {
        this.rRime = rRime;
    }

    public void setdTime(String dTime) {
        this.dTime = dTime;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getBuildName() {
        return buildName;
    }

    public void setBuildName(String buildName) {
        this.buildName = buildName;
    }

    public String getImpName() {
        return impName;
    }

    public void setImpName(String impName) {
        this.impName = impName;
    }

    public String getDeviceName() {
        return deviceName;
    }

    public void setDeviceName(String deviceName) {
        this.deviceName = deviceName;
    }

    public boolean isError() {
        return error;
    }

    public void setError(boolean error) {
        this.error = error;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getResult() {
        return result;
    }

    public void setResult(String result) {
        this.result = result;
    }
}
