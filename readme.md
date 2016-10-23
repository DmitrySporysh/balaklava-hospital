# Спецификация rest сервисов приложения
[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)


## Спецификация сервиса медсестры

#### 1) get: nurse/departments   -  список всех отделений.

Описание полей элементов возвращаемого множества: 
* id - id отделения
* department_name – название отделения
* department_chief_fio - фамилия заведующего отделением

#### 2) get: nurse/department/{id}/chambers   - список всех палаты по данному отделению {id}, в которых есть пациенты

Описание полей элементов возвращаемого множества: 
* id - id палаты
* number – номер палаты (номера палат разных отделений могут совпадать)
* beds_occupied_count – количество занятых койко-мест (сколько человек в палате)

#### 3) get: nurse/chamber/{id} – список всех пациентов в палате {id}

Два элемента возвращаемых данных:
* chamber (инфа для шапки)
     * chamber_id – id палаты
     * number – номер палаты (номера палат разных отделений могут совпадать)
* inpatients – список пациентов стационара. Описание полей элементов этого списка
    * inpatients_id - id пациента стационара
    * fio
    * diagnosis


#### 4) get: nurse/inpatient/{id}   -  инфа о пациенте

Описание полей элементов возвращаемого множества:
1) ФИО
2) Дата рождения
3) Адрес прописки
4) Адрес проживания
5) Семейное положение
6) Место работы
7) Дата поступления в стационар (???Какой стационар, наверно самый последний)
8) Диагноз при поступлении
9) Полис ОМС
10) Группа крови


Поля по связанным таблицами (если что-то из-этого нужно - можно добавить)
* attending_doctor_fio – фио лечащего врача
* district_doctor_fio – фио участкового врача
* department_name – название отделения
* chamber_number – номер палаты
* chamber_floor – этаж, на котором расположена палата


#### 5) get: nurse/patient/{id}/dressings  - список перевязок пациента {id}, отсортированных по дате

Два элемента возвращаемых данных:
* patient
    * patient_fio – фио пациента
    * patient_birth_date – дата рождения
* dressings – список перевязок. Описание полей элементов этого списка
    * dressing_date – дата проведения перевязки
    * dressing_name – название перевязки
    * doctor_fio – фамилия служащего, проводящего перевязку

        
###Остальное описание в файле docs/описание готовых сервисов.docx

#### 6) get: nurse /inpatient/{id}/inspection_protocol  
#### 7) get: nurse/inpatient/{id}/medical_appointments 
#### 8) get: nurse/inpatient/{id}/inspections 
#### 9) get: nurse/inpatient/{id}/analyzes 
#### 10) get: nurse/inpatient/{id}/dressings
#### 11) get: nurse/inpatient/{id}/operations


