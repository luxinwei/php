package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

/**
 * 字典类型
 * Created by zhang on 2018/1/6
 */
public class DictionaryTypeVO extends BaseEntity {

    private static final long serialVersionUID = 7314819556963714650L;

    @NotBlank(message = "编码不能为空")
    @Length(message = "编码长度应为1-30字符",min = 1,max = 30)
    private String code;

    @NotBlank(message = "字典类型名称不能为空")
    @Length(message = "字典类型名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }
}
