<?php
if ( ! defined( 'ABSPATH' ) ) exit;

    global $wpdb;

    $table_employer_profiles = $wpdb->prefix . "wpja_employer_profiles";
    $table_agent_profiles = $wpdb->prefix . "wpja_agent_profiles";
    $table_ac_partners_profiles = $wpdb->prefix . "wpja_ac_partners_profiles";
    $table_agent_company_profiles = $wpdb->prefix . "wpja_agent_company_profiles";
    $table_agent_family_member_profiles = $wpdb->prefix . "wpja_agent_family_member_profiles";
    $table_agent_individual_profiles = $wpdb->prefix . "wpja_agent_individual_profiles";
    $table_agent_partnership_firm_profiles = $wpdb->prefix . "wpja_agent_partnership_firm_profiles";
    $table_countries = $wpdb->prefix . "wpja_countries";
    $table_director_profiles = $wpdb->prefix . "wpja_director_profiles";
    $table_driving_licences = $wpdb->prefix . "wpja_driving_licences";
    $table_education = $wpdb->prefix . "wpja_education";
    $table_education_levels = $wpdb->prefix . "wpja_education_levels";
    $table_employer_company_profiles = $wpdb->prefix . "wpja_employer_company_profiles";
    $table_employer_company_profile_job_preference = $wpdb->prefix . "wpja_employer_company_profile_job_preference";
    $table_employer_individual_profiles = $wpdb->prefix . "wpja_employer_individual_profiles";
    $table_employer_individual_profile_job_preference = $wpdb->prefix . "wpja_employer_individual_profile_job_preference";
    $table_jobseeker_profiles = $wpdb->prefix . "wpja_jobseeker_profiles";
    $table_jobseeker_profile_driving_licence = $wpdb->prefix . "wpja_jobseeker_profile_driving_licence";
    $table_jobseeker_profile_skill = $wpdb->prefix . "wpja_jobseeker_profile_skill";
    $table_jobseeker_profile_vehicle = $wpdb->prefix . "wpja_jobseeker_profile_vehicle";
    $table_job_positions = $wpdb->prefix . "wpja_job_positions";
    $table_job_preferences = $wpdb->prefix . "wpja_job_preferences";
    $table_job_titles = $wpdb->prefix . "wpja_job_titles";
    $table_partners_profiles = $wpdb->prefix . "wpja_partners_profiles";
    $table_skills = $wpdb->prefix . "wpja_skills";
    $table_vehicles = $wpdb->prefix . "wpja_vehicles";
    $table_work_experiences = $wpdb->prefix . "wpja_work_experiences";
    $table_job_types = $wpdb->prefix . "wpja_job_types";
    $table_settings = $wpdb->prefix . "wpja_settings";


    $charset_collate = $wpdb->get_charset_collate();

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $sql_jobseeker_profiles = "CREATE TABLE IF NOT EXISTS $table_jobseeker_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100),
        surname varchar(100),
        passport_number varchar(100),
        email varchar(100),
        gender varchar(10),
        address varchar(100),
        town varchar(100),
        postcode varchar(100),
        country_id int,
        country_origin_id int,
        tel_land_line int,
        tel_mobile int,
        date_of_birth timestamp,
        education_level_id int,
        cv_resume_url text,
        identity_card_url text,
        passport_url text,
        driving_licence_url text,
        international_driving_permit_url text,
        driving_licence_2nd_part_url text,
        education_certificate1_url text,
        education_certificate2_url text,
        education_certificate3_url text,
        work_certificate1_url text,
        work_certificate2_url text,
        work_certificate3_url text,
        police_conduct_url text,
        user_id int DEFAULT NULL,
        agent_id int DEFAULT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    dbDelta($sql_jobseeker_profiles);

    $sql_countries = "CREATE TABLE IF NOT EXISTS $table_countries (
        id int(11) NOT NULL AUTO_INCREMENT,
        country_code varchar(2) NOT NULL,
        country_name varchar(100) NOT NULL UNIQUE,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_countries);

    $sql_vehicles = "CREATE TABLE IF NOT EXISTS $table_vehicles (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL UNIQUE,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_vehicles);

    $sql_education_levels = "CREATE TABLE IF NOT EXISTS $table_education_levels (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL UNIQUE,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_education_levels);

    $sql_driving_licences = "CREATE TABLE IF NOT EXISTS $table_driving_licences (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL UNIQUE,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_driving_licences);

    $sql_jobseeker_profile_driving_licence = "CREATE TABLE IF NOT EXISTS $table_jobseeker_profile_driving_licence (
        id int(11) NOT NULL AUTO_INCREMENT,
        jobseeker_profile_id int(11) NOT NULL,
        driving_licence_id int(11) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_jobseeker_profile_driving_licence);

    $sql_jobseeker_profile_vehicle = "CREATE TABLE IF NOT EXISTS $table_jobseeker_profile_vehicle (
        id int(11) NOT NULL AUTO_INCREMENT,
        jobseeker_profile_id int(11) NOT NULL,
        vehicle_id int(11) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_jobseeker_profile_vehicle);

    $sql_agent_company_profiles = "CREATE TABLE IF NOT EXISTS $table_agent_company_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        business_name varchar(100),
        full_business_address varchar(100),
        postcode varchar(20),
        commission_address varchar(100),
        phone varchar(100),
        fax varchar(100),
        email varchar(100),
        web varchar(100),
        company_registration_number varchar(100),
        articles_of_association_url text,
        certificate_of_incorporation_url text,
        memorandum_of_association_url text,
        telephone_bill_url text,
        bank_account_statement_url text,
        electricity_bill_url text,
        telephone_bill1_url text,
        lease_rent_agreement_url text,
        other_document_url text,
        police_conduct_for_directors_url text,
        all_directors_passports_url text,
        user_id int(11),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_agent_company_profiles);

    $sql_agent_individual_profiles = "CREATE TABLE IF NOT EXISTS $table_agent_individual_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100),
        surname varchar(100),
        email varchar(20),
        passport_url text,
        driving_licence_url text,
        ration_card_with_photo_url text,
        bank_ac_pass_book_with_photo_url text,
        bank_account_statement_url text,
        birth_certificate_url text,
        electricity_bill_url text,
        rent_agreement_url text,
        police_conduct_url text,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_agent_individual_profiles);

    $sql_ac_partners_profiles = "CREATE TABLE IF NOT EXISTS $table_ac_partners_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        agent_company_profile_id int(11),
        forename varchar(100),
        surname varchar(100),
        date_of_birth timestamp,
        national_insurance_number varchar(100),
        position_in_firm varchar(100),
        home_address varchar(100),
        postcode varchar(100),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_ac_partners_profiles);

    $sql_agent_family_member_profiles = "CREATE TABLE IF NOT EXISTS $table_agent_family_member_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100),
        surname varchar(100),
        email varchar(100),
        family_relation varchar(100),
        passport_url text,
        driving_licence_url text,
        ration_card_with_photo_url text,
        bank_ac_pass_book_with_photo_url text,
        bank_account_statement_url text,
        birth_certificate_url text,
        electricity_bill_url text,
        rent_agreement_url text,
        police_conduct_url text,
        user_id int(11),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_agent_family_member_profiles);

    $sql_director_profiles = "CREATE TABLE IF NOT EXISTS $table_director_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        document_to_identify_partner_holding_power_of_attorney_url text,
        partnership_deed_url text,
        power_of_attorney_granted_to_transact_business_on_its_behalf_url text,
        VAT_registration_certificate_url text,
        telephone_bill_url text,
        registration_certificate_url text,
        bank_account_statement_url text,
        electricity_bill_url text,
        telephone_bill1_url text,
        lease_rent_agreement_url text,
        police_conduct_for_directors_url text,
        all_directors_passports_url text,
        user_id int(11),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_director_profiles);

    $sql_agent_partnership_firm_profiles = "CREATE TABLE IF NOT EXISTS $table_agent_partnership_firm_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        firm_name varchar(100),
        full_firm_address varchar(100),
        postcode varchar(20),
        commission_address varchar(100),
        phone varchar(100),
        fax varchar(100),
        email varchar(100),
        web varchar(100),
        firm_registration_number varchar(100),
        identify_partner_holding_power_of_attorney_url text,
        partnership_deed_url text,
        transact_business_on_attorneys_behalf_url text,
        vat_registration_certificate_url text,
        telephone_bill_url text,
        bank_account_statement_url text,
        electricity_bill_url text,
        telephone_bill1_url text,
        lease_rent_agreement_url text,
        police_conduct_for_directors_url text,
        all_directors_passports_url text,
        user_id int(11),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_agent_partnership_firm_profiles);

    $sql_education = "CREATE TABLE IF NOT EXISTS $table_education (
        id int(11) NOT NULL AUTO_INCREMENT,
        jobseeker_profile_id int(11) NOT NULL,
        course_name varchar(100) NOT NULL,
        date_start timestamp NOT NULL,
        date_finish timestamp NOT NULL,
        institution_name varchar(100) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_education);

    $sql_employer_company_profiles = "CREATE TABLE IF NOT EXISTS $table_employer_company_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        business_name varchar(100),
        full_business_address varchar(100),
        postcode varchar(100),
        commission_address varchar(100),
        phone varchar(100),
        fax varchar(100),
        email varchar(100),
        web varchar(100),
        company_registration_number varchar(100),
        service_provider_details varchar(100),
        bank_name varchar(100),
        bank_address varchar(100),
        bank_postcode varchar(100),
        country_id int(11),
        sort_code varchar(100),
        IBAN_number varchar(100),
        account_name varchar(100),
        user_id int(11),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_employer_company_profiles);

    $sql_employer_company_profile_job_preference = "CREATE TABLE IF NOT EXISTS $table_employer_company_profile_job_preference (
        id int(11) NOT NULL AUTO_INCREMENT,
        employer_company_profile_id int(11) NOT NULL,
        job_preference_id int(11) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_employer_company_profile_job_preference);

    $sql_employer_individual_profiles = "CREATE TABLE IF NOT EXISTS $table_employer_individual_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100),
        surname varchar(100),
        email varchar(100),
        passport_number varchar(100),
        gender varchar(100),
        address varchar(100),
        town varchar(100),
        postcode varchar(100),
        country int(11),
        country_origin int(11),
        tel_land_line varchar(100),
        tel_mobile varchar(100),
        date_of_birth timestamp,
        user_id int(11),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_employer_individual_profiles);

    $sql_employer_individual_profile_job_preference = "CREATE TABLE IF NOT EXISTS $table_employer_individual_profile_job_preference (
        id int(11) NOT NULL AUTO_INCREMENT,
        employer_individual_profile_id int(11),
        job_preference_id int(11),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_employer_individual_profile_job_preference);

    $sql_jobseeker_profile_driving_licence = "CREATE TABLE IF NOT EXISTS $table_jobseeker_profile_driving_licence (
        id int(11) NOT NULL AUTO_INCREMENT,
        driving_licence_id int(11),
        jobseeker_profile_id int(11),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_jobseeker_profile_driving_licence);

    $sql_jobseeker_profile_skill = "CREATE TABLE IF NOT EXISTS $table_jobseeker_profile_skill (
        id int(11) NOT NULL AUTO_INCREMENT,
        jobseeker_profile_id int(11),
        skill_id int(11),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_jobseeker_profile_skill);

    $sql_jobseeker_profile_vehicle = "CREATE TABLE IF NOT EXISTS $table_jobseeker_profile_vehicle (
        id int(11) NOT NULL AUTO_INCREMENT,
        vehicle_id int(11),
        jobseeker_profile_id int(11),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_jobseeker_profile_vehicle);

    $sql_job_positions = "CREATE TABLE IF NOT EXISTS $table_job_positions (
        id int(11) NOT NULL AUTO_INCREMENT,
        job_title_id int(11),
        employer_company_profile_id int(11),
        requirements text,
        benefits text,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_job_positions);

    $sql_job_preferences = "CREATE TABLE IF NOT EXISTS $table_job_preferences (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_job_preferences);

    $sql_partners_profiles = "CREATE TABLE IF NOT EXISTS $table_partners_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        agent_company_profile_id int(11),
        forename varchar(100),
        surname varchar(100),
        date_of_birth timestamp,
        national_insurance_number varchar(100),
        position_in_firm varchar(100),
        home_address varchar(100),
        postcode varchar(20),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_partners_profiles);

    $sql_job_titles = "CREATE TABLE IF NOT EXISTS $table_job_titles (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        description text,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_job_titles);

    $sql_skills = "CREATE TABLE IF NOT EXISTS $table_skills (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_skills);

    $sql_work_experiences = "CREATE TABLE IF NOT EXISTS $table_work_experiences (
        id int(11) NOT NULL AUTO_INCREMENT,
        jobseeker_profile_id int(11),
        job_type int(11),
        position_held varchar(100),
        date_start timestamp,
        date_finish timestamp,
        company_name varchar(100),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_work_experiences);

    $sql_job_types = "CREATE TABLE IF NOT EXISTS $table_job_types (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(100),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_job_types);

    $sql_settings = "CREATE TABLE IF NOT EXISTS $table_settings (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(50) NOT NULL UNIQUE,
        value varchar(50) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_settings);

    $sql_agent_profiles = "CREATE TABLE IF NOT EXISTS $table_agent_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id int(11),
        user_category varchar(20),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_agent_profiles);

    $sql_employer_profiles = "CREATE TABLE IF NOT EXISTS $table_employer_profiles (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id int(11),
        user_category varchar(20),
        PRIMARY KEY (id)
    ) $charset_collate;";

    dbDelta($sql_employer_profiles);

    include 'initial_queries.php';