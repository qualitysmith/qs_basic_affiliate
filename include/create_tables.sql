CREATE TABLE tasks (
	id serial PRIMARY KEY,
	trade text,
	first_name text,
	last_name text,
	address text,
	zip text,
	phone text,
	alternate_phone	text,
	email text,
	trade_questions text,
	request_xml text,
	response_xml text,
	accepted boolean,
	created_at timestamp with time zone,
	updated_at timestamp with time zone
);
