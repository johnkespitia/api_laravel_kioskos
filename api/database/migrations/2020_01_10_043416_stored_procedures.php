<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP procedure IF EXISTS editarPersona");
        $editarPersona = "
            CREATE PROCEDURE `editarPersona`(in cedulaAnterior varchar(12), in nuevaCedula varchar(12),in tipo_documento int, in p_nombre varchar(100),
            in s_nombre varchar(100),in p_apellido varchar(100),in s_apellido varchar(100))
            BEGIN
                update persona 
                set numero_documento = nuevaCedula, 
                    primer_nombre=p_nombre, 
                    segundo_nombre = s_nombre, 
                    primer_apellido = p_apellido, 
                    segundo_apellido = s_apellido, 
                    tipo_documento_id = tipo_documento,
                    persona.fecha_actualizacion = sysdate()
                where numero_documento = cedulaAnterior 
                    and disponible = 1;
                select 'PERSONA ACTUALIZADA' as mensaje from dual;
            END
        ";
        DB::unprepared($editarPersona);

        DB::unprepared("DROP procedure IF EXISTS eliminarPersona");
        $eliminarPersona = "
        CREATE PROCEDURE `eliminarPersona`(in cedula varchar(12))
        BEGIN
            update persona 
            set disponible = 0 ,
            persona.fecha_actualizacion = sysdate()
            where numero_documento = cedula;
            select 'PERSONA ELIMINADA' as mensaje from dual;
        END
        ";
        DB::unprepared($eliminarPersona);


        DB::unprepared("DROP procedure IF EXISTS listadoPersonas");
        $listadoPersonas = "
            CREATE PROCEDURE `listadoPersonas`()
            BEGIN
                select 
                    persona.primer_nombre, 
                    persona.segundo_nombre,
                    persona.primer_apellido,
                    persona.segundo_apellido,
                    persona.numero_documento,
                    tipo_documento.tipo_documento
                    from persona inner join tipo_documento on persona.tipo_documento_id = tipo_documento.id
                    where disponible = 1; 
            END
        ";
        DB::unprepared($listadoPersonas);


        DB::unprepared("DROP procedure IF EXISTS listadoTiposDocumento");
        $listadoTiposDocumento = "
                CREATE PROCEDURE `listadoTiposDocumento`()
                BEGIN
                select id,tipo_documento from tipo_documento;
                END
        ";
        DB::unprepared($listadoTiposDocumento);
        

        DB::unprepared("DROP procedure IF EXISTS obtenerPersona");
        $obtenerPersona = "
        CREATE PROCEDURE `obtenerPersona`(in cedula varchar(12))
        BEGIN
            select 
                persona.primer_nombre, 
                persona.segundo_nombre,
                persona.primer_apellido,
                persona.segundo_apellido,
                persona.numero_documento,
                tipo_documento.tipo_documento,
                persona.fecha_registro,
                persona.fecha_actualizacion
                from persona inner join tipo_documento on persona.tipo_documento_id = tipo_documento.id
                where numero_documento = cedula
                and disponible = 1;
        END
        ";
        DB::unprepared($obtenerPersona);


        DB::unprepared("DROP procedure IF EXISTS nuevaPersona");
        $nuevaPersona = "
        CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevaPersona`(in cedula varchar(12),in tipo_documento int, in p_nombre varchar(100),
        in s_nombre varchar(100),in p_apellido varchar(100),in s_apellido varchar(100))
        BEGIN
             DECLARE done INT DEFAULT FALSE;
             DECLARE va INT;
             declare estado int;
             DECLARE cur CURSOR for select id, disponible from persona where numero_documento = cedula limit 1;
             DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=TRUE;
             OPEN cur;
              read_loop: LOOP
                FETCH cur INTO va, estado;
                if va is null then
                    insert into persona (primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,numero_documento,tipo_documento_id,persona.fecha_registro,persona.fecha_actualizacion) values (p_nombre, s_nombre, p_apellido, s_apellido, cedula, tipo_documento,sysdate(),sysdate());
                    select 'PERSONA REGISTRADA' as mensaje from dual;
                else
                    if estado = 0 then
                        update persona 
                        set 
                            numero_documento = cedula,
                            primer_nombre=p_nombre, 
                            segundo_nombre = s_nombre, 
                            primer_apellido = p_apellido, 
                            segundo_apellido = s_apellido, 
                            tipo_documento_id = tipo_documento,
                            disponible = 1,
                            persona.fecha_actualizacion = sysdate()
                        where id = va; 
                        select 'PERSONA REGISTRADA' as mensaje from dual;
                    else
                        select 'PERSONA EXISTE' as mensaje from dual;
                    end if;
                end if;
                IF done THEN
                  LEAVE read_loop;
                END IF;
              END LOOP;
              CLOSE cur; 
        END
        ";
        DB::unprepared($nuevaPersona);
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
