package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;
import org.omg.PortableInterceptor.INACTIVE;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.util.Date;

/**
 * 系统日志
 * Created by zhang on 2018/1/7
 */
public class SystemLogVO extends BaseEntity {

    private static final long serialVersionUID = -3877048025532183349L;

    @Length(message = "系统名称长度应为1-20字符",min = 1,max = 20)
    private String name;

    //TODO 字典项添加，是否有必要
    /** 日志类型 运行日志，心跳日志 */
    private Integer type;

    /** 日志类型 1:启动 2:停止 3:心跳 */
    private Integer state;

    private Date createTime;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public Integer getType() {
        return type;
    }

    public void setType(Integer type) {
        this.type = type;
    }

    public Integer getState() {
        return state;
    }

    public void setState(Integer state) {
        this.state = state;
    }

    public Date getCreateTime() {
        return createTime;
    }

    public void setCreateTime(Date createTime) {
        this.createTime = createTime;
    }
}
