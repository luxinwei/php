			package com.gdlion.dpi.domain.vo;

/**
 * 极光消息推送专用对象，用以描述通知栏数据结构
 */
public class MsgVo {
    private String title;//标题
    private String content;//内容
    private Long time;//产生时间
    private Integer type;//消息类型 101:报警;102:预警;103:待维修;104:待保养;105:系统公告;106:待巡查;107:待培训;108:待演练

    public MsgVo() {
    }

    public MsgVo(String title, String content, Long time, Integer type) {
        this.title = title;
        this.content = content;
        this.time = time;
        this.type = type;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public Long getTime() {
        return time;
    }

    public void setTime(Long time) {
        this.time = time;
    }

    public Integer getType() {
        return type;
    }

    public void setType(Integer type) {
        this.type = type;
    }

}
