package com.gdlion.dpi.domain.vo.monitor;

import java.io.Serializable;

/**
 * Created by zhao on 2018/2/3.
 *
 * 告警
 */
public class EventVO implements Serializable{

    private static final long serialVersionUID = 3594537158856975005L;

    /**主键id*/
    private String id;

    /** 装置ID */
    private Long tid;

    /** 单位ID */
    private Long cid;

    private String cname;

    /** 创建时间 */
    private Long ctime;

    private String alarmTime;

    private Long rtime;

    /** 告警类型 */
    private Long type;

    /** 告警内容 */
    private String content;

    /** 告警来源 */
    private Long source;

    /** 告警状态 */
    private Long state;

    private String stateText;

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public Long getTid() {
        return tid;
    }

    public void setTid(Long tid) {
        this.tid = tid;
    }

    public Long getCid() {
        return cid;
    }

    public void setCid(Long cid) {
        this.cid = cid;
    }

    public Long getCtime() {
        return ctime;
    }

    public void setCtime(Long ctime) {
        this.ctime = ctime;
    }

    public Long getRtime() {
        return rtime;
    }

    public void setRtime(Long rtime) {
        this.rtime = rtime;
    }

    public Long getType() {
        return type;
    }

    public void setType(Long type) {
        this.type = type;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public Long getSource() {
        return source;
    }

    public void setSource(Long source) {
        this.source = source;
    }

    public Long getState() {
        return state;
    }

    public void setState(Long state) {
        this.state = state;
    }

    public String getCname() {
        return cname;
    }

    public void setCname(String cname) {
        this.cname = cname;
    }

    public String getStateText() {
        return stateText;
    }

    public void setStateText(String stateText) {
        this.stateText = stateText;
    }

    public String getAlarmTime() {
        return alarmTime;
    }

    public void setAlarmTime(String alarmTime) {
        this.alarmTime = alarmTime;
    }
}
