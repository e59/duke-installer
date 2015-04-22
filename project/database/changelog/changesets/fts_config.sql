--liquibase formatted sql


--changeset duke:fts_config


-- just copy and paste this example for each table

alter table EXAMPLE_TABLE add column fts tsvector;
alter table EXAMPLE_TABLE add column plain text;

CREATE INDEX fts_EXAMPLE_TABLE_idx ON EXAMPLE_TABLE USING gin (fts);
CREATE TRIGGER fts_EXAMPLE_TABLE_update BEFORE INSERT OR UPDATE ON EXAMPLE_TABLE
FOR EACH ROW EXECUTE PROCEDURE t_fts_update('TEXT_COLUMN_1', 'COLUMN_2'); -- add as many parameters as necessary

