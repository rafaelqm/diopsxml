<?php

class EnderecoController extends BaseController {

	public function getCidades($estado){
		return Municipio::where('uf','=',$estado)->lists('descricao','municipioIBGE');
	}
}

?>