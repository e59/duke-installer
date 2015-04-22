--liquibase formatted sql


--changeset duke:fts splitStatements:false

CREATE OR REPLACE FUNCTION strip_tags(in_text text, in_allowed text)
  RETURNS text AS
$BODY$
DECLARE
   m record;
   v_matches text[];
   v_allowed text[] := (CASE WHEN in_allowed IS NOT NULL THEN string_to_array(in_allowed, ',') ELSE ARRAY[]::text[] END);
   v_result text := in_text;
BEGIN
   FOR m IN SELECT regexp_matches($1, E'(</?([a-z0-9_\-]+) *[^>]*>)', 'g') i LOOP
      IF (m.i[2] = ANY(v_allowed)) = FALSE THEN
         v_result := replace(v_result, m.i[1], '');
      END IF;
   END LOOP;
   RETURN v_result;
END;
$BODY$
  LANGUAGE plpgsql IMMUTABLE
  COST 100;


CREATE OR REPLACE FUNCTION unaccent_string(text) RETURNS text AS $$
DECLARE
    input_string text := $1;
BEGIN

input_string := translate(input_string, 'âãäåāăąÁÂÃÄÅĀĂĄ', 'aaaaaaaaaaaaaaa');
input_string := translate(input_string, 'èééêëēĕėęěĒĔĖĘĚ', 'eeeeeeeeeeeeeee');
input_string := translate(input_string, 'ìíîïìĩīĭÌÍÎÏÌĨĪĬ', 'iiiiiiiiiiiiiiii');
input_string := translate(input_string, 'óôõöōŏőÒÓÔÕÖŌŎŐ', 'ooooooooooooooo');
input_string := translate(input_string, 'ùúûüũūŭůÙÚÛÜŨŪŬŮ', 'uuuuuuuuuuuuuuuu');
input_string := translate(input_string, 'Ññ', 'nn');
input_string := translate(input_string, 'Çç', 'cc');
input_string := regexp_replace(input_string, E'[\\n\\r]+', ' ', 'g');

return lower(input_string);
END;
$$ LANGUAGE plpgsql;


CREATE or replace FUNCTION t_fts_update() RETURNS TRIGGER AS $$
declare __text text;
BEGIN
	execute format('select unaccent_string(strip_tags(coalesce($1.' || array_to_string(TG_ARGV, ', '''') || '' '' || coalesce($1.') || ', ''''), ''''))') into __text using NEW;
	NEW.plain := __text;
	NEW.fts := to_tsvector('pg_catalog.portuguese', COALESCE(NEW.plain, ''));
	RETURN NEW;
END
$$ LANGUAGE 'plpgsql';


















