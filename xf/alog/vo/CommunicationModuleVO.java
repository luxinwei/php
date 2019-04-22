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
 * 通讯模组
 * Created by zhang on 2018/1/8
 */
public class CommunicationModuleVO extends BaseEntity {

    private static final long serialVersionUID = 7942407462316279740L;

    @Length(message = "唯一标示长度应为1-32字符",min = 1,max = 32)
    private String sid;

    @NotNull(message = "所属业主单位id不能为空")
    private Long depId;

    @NotBlank(message = "模组名称不能为空")
    @Length(message = "模组名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "通讯模组类型不能为空")
    @DictionaryCodeValidate(message = "通讯模组类型不符合规范", dictionaryData = "1,2")
    private String comMouldCode;

    private String comMouldName;

    @Length(message = "安装位置长度应为1-100字节",min = 1,max = 100)
    private String position;

    @Length(message = "描述信息长度应为1-100字节",min = 1,max = 100)
    private String description;

    private String depName;//所属业主单位名称

    public String getSid() {
        return sid;
    }

    public void setSid(String sid) {
        this.sid = sid;
    }

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

    public String getComMouldCode() {
        return comMouldCode;
    }

    public void setComMouldCode(String comMouldCode) {
        this.comMouldCode = comMouldCode;
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

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }

    public String getComMouldName() {
        return comMouldName;
    }

    public void setComMouldName(String comMouldName) {
        this.comMouldName = comMouldName;
    }
}
