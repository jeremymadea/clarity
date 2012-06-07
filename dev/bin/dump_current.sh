#!/bin/sh

mysqldump -uroot                  current > current_with_sample_data.sql
mysqldump -uroot --no-create-info current > current_sample_data_only.sql
mysqldump -uroot --no-data        current > current.sql
mysqldump -uroot --no-create-info current \
    pseudopotentials atoms param_descriptions cp_parameters am1_parameters \
    > current_production_data.sql

