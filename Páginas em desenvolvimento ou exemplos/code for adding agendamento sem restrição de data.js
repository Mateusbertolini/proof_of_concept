function salvar() {
    var dataAgendamento = document.getElementById("dataAgendamento").value;
    var pacienteAgendamento = document.getElementById("pacienteAgendamento").value;
    var procedimentoAgendamento = document.getElementById("procedimentoAgendamento").value;
    var localAgendamento = document.getElementById("localAgendamento").value;
    var turnoAgendamento = document.getElementById("turnoAgendamento").value;
    var disciplinaAgendamento = document.getElementById("disciplinaAgendamento").value;
    
    // Check if localAgendamento and turnoAgendamento are not 'Escolher'
    if (localAgendamento !== "Escolher" && turnoAgendamento !== "Escolher") {
      var table = document.getElementById("listaAgendamento");
  
      // Check if the combination of pacienteAgendamento, dataAgendamento, and turnoAgendamento already exists
      var duplicateExists = false;
      for (var i = 1; i < table.rows.length; i++) {
        var rowDataCell = table.rows[i].cells[1]; // Cell containing dataAgendamento
        var rowData = rowDataCell.textContent.trim();
        var rowPacienteCell = table.rows[i].cells[2]; // Cell containing pacienteAgendamento
        var rowPaciente = rowPacienteCell.textContent.trim();
        var rowTurnoCell = table.rows[i].cells[5]; // Cell containing turnoAgendamento
        var rowTurno = rowTurnoCell.textContent.trim();
        
        if (rowData === dataAgendamento && rowPaciente === pacienteAgendamento && rowTurno === turnoAgendamento) {
          duplicateExists = true;
          break;
        }
      }
  
      if (!duplicateExists) {
        var newRow = table.insertRow(-1);
        
        var checkboxCell = newRow.insertCell(0);
        checkboxCell.innerHTML = '<input type="checkbox">';
        checkboxCell.className = "ui-state-default ui-th-column ui-th-ltr";
  
        var dataCell = newRow.insertCell(1);
        dataCell.innerHTML = dataAgendamento;
        dataCell.className = "ui-state-default ui-th-column ui-th-ltr";
  
        var pacienteCell = newRow.insertCell(2);
        pacienteCell.innerHTML = pacienteAgendamento;
        pacienteCell.className = "ui-state-default ui-th-column ui-th-ltr";
  
        var procedimentoCell = newRow.insertCell(3);
        procedimentoCell.innerHTML = procedimentoAgendamento;
        procedimentoCell.className = "ui-state-default ui-th-column ui-th-ltr";
  
        var localCell = newRow.insertCell(4);
        localCell.innerHTML = localAgendamento;
        localCell.className = "ui-state-default ui-th-column ui-th-ltr";
  
        var turnoCell = newRow.insertCell(5);
        turnoCell.innerHTML = turnoAgendamento;
        turnoCell.className = "ui-state-default ui-th-column ui-th-ltr";
  
        var disciplinaCell = newRow.insertCell(6);
        disciplinaCell.innerHTML = disciplinaAgendamento;
        disciplinaCell.className = "ui-state-default ui-th-column ui-th-ltr";
      
  
        // Clear input fields after adding/updating row
        document.getElementById("dataAgendamento").value = "";
        document.getElementById("pacienteAgendamento").value = "";
        document.getElementById("procedimentoAgendamento").value = "";
        document.getElementById("localAgendamento").value = "Escolher";
        document.getElementById("turnoAgendamento").value = "Escolher"; 
        document.getElementById("disciplinaAgendamento").value = "";
      } else {
        alert("Paciente já tem atendimento agendado para este mesmo dia e turno.");
      }
    } else {
      alert("Por favor, selecione um local e turno válidos.");
    }
  }