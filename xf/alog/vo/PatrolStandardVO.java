package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

/**
 * 检查标准
 * Created by wangyuan on 2018/1/6
 */
public class PatrolStandardVO extends BaseEntity {

    private static final long serialVersionUID = 6013151549022797803L;

    @NotBlank(message = "巡查目标不能为空")
    @Length(message = "巡查目标长度应为1-50字符", min = 1, max = 50)
    private String target;

    @NotBlank(message = "检查项不能为空")
    @Length(message = "检查下项长度应为1-50字符", min = 1, max = 50)
    private String checkItem;

    @Length(message = "正常情况描述长度应为1-300字符", min = 1, max = 300)
    private String normalCondition;

    @Length(message = "异常情况描述长度应为1-300字符", min = 1, max = 300)
    private String abnormalCondition;

    public String getTarget() {
        return target;
    }

    public void setTarget(String target) {
        this.target = target;
    }

    public String getCheckItem() {
        return checkItem;
    }

    public void setCheckItem(String checkItem) {
        this.checkItem = checkItem;
    }

    public String getNormalCondition() {
        return normalCondition;
    }

    public void setNormalCondition(String normalCondition) {
        this.normalCondition = normalCondition;
    }

    public String getAbnormalCondition() {
        return abnormalCondition;
    }

    public void setAbnormalCondition(String abnormalCondition) {
        this.abnormalCondition = abnormalCondition;
    }
}
