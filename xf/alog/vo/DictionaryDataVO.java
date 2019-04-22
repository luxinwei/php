package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Max;
import javax.validation.constraints.Min;
import javax.validation.constraints.NotNull;
import java.math.BigInteger;

/**
 * 字典类型
 * Created by zhang on 2018/1/6
 */
public class DictionaryDataVO extends BaseEntity {

    private static final long serialVersionUID = 4735582779830670869L;

    @NotNull(message = "字典类型不能为空")
    private Long typeId;

    @NotBlank(message = "字典类型编码不能为空")
    @Length(message = "字典类型编码长度应为1-50字符",min = 1,max = 50)
    private String code;

    @NotBlank(message = "字典项名称不能为空")
    @Length(message = "字典项名称长度应为1-50字符",min = 1,max = 50)
    private String name;

    @NotBlank(message = "字典值不能为空")
    @Length(message = "字典值长度应为1-50字符",min = 1,max = 50)
    private String value;

    /** 父节点id */
    private Long parentId;

    @NotNull(message = "字典排序不能为空")
    @Min(message = "字典项排序编号最小为1", value = 1)
    @Max(message = "字典项排序编号最大为99", value = 99)
    private Integer sort;

    public Long getTypeId() {
        return typeId;
    }

    public void setTypeId(Long typeId) {
        this.typeId = typeId;
    }

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

    public String getValue() {
        return value;
    }

    public void setValue(String value) {
        this.value = value;
    }

    public Long getParentId() {
        return parentId;
    }

    public void setParentId(Long parentId) {
        this.parentId = parentId;
    }

    public Integer getSort() {
        return sort;
    }

    public void setSort(Integer sort) {
        this.sort = sort;
    }
}
