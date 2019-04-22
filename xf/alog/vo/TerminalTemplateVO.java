package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import java.util.List;

/**
 * 装置模板
 *Created by zhang on 2018/1/19
 */
public class TerminalTemplateVO extends BaseEntity {

    private static final long serialVersionUID = -6000977751075451152L;

    @NotBlank(message = "装置模板名称不能为空")
    @Length(message = "装置模板名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "装置模板型号不能为空")
    @Length(message = "装置模板型号长度应为1-100字符",min = 1,max = 100)
    private String model;

    private List<MeasurePointVO> measurePointVOList; //测点集合

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getModel() {
        return model;
    }

    public void setModel(String model) {
        this.model = model;
    }

    public List<MeasurePointVO> getMeasurePointVOList() {
        return measurePointVOList;
    }

    public void setMeasurePointVOList(List<MeasurePointVO> measurePointVOList) {
        this.measurePointVOList = measurePointVOList;
    }
}
