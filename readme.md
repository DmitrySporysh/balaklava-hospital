# Спецификация rest сервисов прилоежния
[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)


## f Спецификация сервиса медсестры

#### 1) get: nurse/departments   -  список всех отделений.

Описание полей элементов возвращаемого множества: 
* department_name – название отделения 1

#### 2) get: nurse/department/{id}/chambers   - список всех палаты по данному отделению {id}, в которых есть пациенты

Описание полей элементов возвращаемого множества: 
* number – номер палаты (номера палат разных отделений могут совпадать 1
* beds_occupied_count – количество занятых койко-мест (сколько человек в палате) 2

#### 3) get: nurse/chamber/{id} – список всех пациентов в палате {id}

Описание полей элементов возвращаемого множества: 


#### 4) get: nurse/patient/{id}   -  инфа о пациенте

Описание полей элементов возвращаемого множества:
* patient_fio – фио пациента 1
* patient_sex - пол 2
* patient_birth_date – дата рождения 3
* receipt_date  - дата поступления 4
* initial_inspection –  результаты первичного осмотра 5
* preliminary_diagnosis  - предварительный диагноз 6
* confirmed_diagnosis – уточненный диагноз 7

Поля по связанным таблицами:
* attending_doctor_fio – фио лечащего врача 8
* district_doctor_fio – фио участкового врача 9
* department_name – название отделения 10
* chamber_number – номер палаты 11
* chamber_floor – этаж, на котором расположена палата 12


#### 5) get: nurse/patient/{id}/dressings  - список перевязок пациента {id}, отсортированных по дате

Два элемента возвращаемых данных:
* patient 1
     * patient_fio – фио пациента 1a
     * patient_birth_date – дата рождения 1b
* dressings 2– список перевязок. Описание полей элементов этого списка
     * dressing_date – дата проведения перевязки 2a
     * dressing_name – название перевязки 2b
     * doctor_fio – фамилия служащего, проводящего перевязку 2c

        


#### 6) get: nurse/patient/{id}/inspections - список осмотров пациента {id}, отсортированных по дате

Два элемента возвращаемых данных:
patient: patient_fio – фио пациента
               patient_birth_date – дата рождения
inspections – список осмотров пациента. Описание полей элементов этого списка
               inspection_date  – дата проведения осмотра
               result_text – результат проведения осмотра
               doctor_fio – фамилия служащего, проводящего осмотр пациента

#### 7) get: nurse/patient/{id}/operations - список операций пациента {id}, отсортированных по дате

Два элемента возвращаемых данных:
patient: patient_fio – фио пациента
               patient_birth_date – дата рождения
operations – список осмотров пациента. Описание полей элементов этого списка
               operation_date – дата проведения операции
               operation_name – название операции
               preliminary_epicrisis – предоперационный эпикриз
               result – результат проведения операции
               doctor_fio – фамилия служащего, проводящего операцию пациента

#### 8) get: nurse/patient/{id}/surveys - список обследований пациента {id}, отсортированных по дате

Два элемента возвращаемых данных:
patient: patient_fio – фио пациента
               patient_birth_date – дата рождения
surveys – список обследований пациента. Описание полей элементов этого списка
               survey_name – название обследования
               survey_date  – дата начала обследования
               status – статус обследования (true, false) – (завершенно/незавершенно)
               result_text – результат проведения обследования
               result_file – файл с результатами обследования (пока что это просто ТЕКСТ)
               doctor_fio – фамилия служащего (доктора), который назначил пациенту это обследование 
               survey_type_name – тип обследования
               description – описание типа обследования
               room_number – номер кабинета для проведения обследования (просто текст)


#### 9) get: nurse/patient/{id}/ treatments  - список лечений пациента {id}, отсортированных по дате

Два элемента возвращаемых данных:
patient: patient_fio – фио пациента
               patient_birth_date – дата рождения
operations – список лечений пациента. Описание полей элементов этого списка
               date – дата назначения лечения
               treatment_name  – название лечения
               description – описания данного лечения
               doctor_fio – фамилия служащего (доктора), который назначил пациенту это лечение


## Спецификация сервиса рабочего регистратуры

