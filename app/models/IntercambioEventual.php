<?php

class IntercambioEventual extends Eloquent {
	protected $table = "intercambioEventual";

	protected $fillable = [	'tipo',
							'tipoCobertura',
							'registroOperadora',
							'saldoIntercambio',
							'dataVencimento',
							'inicioPeriodo'];
}