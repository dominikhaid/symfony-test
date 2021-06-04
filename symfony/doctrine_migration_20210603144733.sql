-- Doctrine Migration File Generated on 2021-06-03 14:47:33

-- Version DoctrineMigrations\Version20210602002319
ALTER TABLE team ALTER id SET NOT NULL;
ALTER TABLE team ALTER first_name SET NOT NULL;
ALTER TABLE team ALTER last_name SET NOT NULL;
ALTER TABLE team ADD PRIMARY KEY (id);
