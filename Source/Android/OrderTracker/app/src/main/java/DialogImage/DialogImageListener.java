package DialogImage;

import android.view.View;
import android.widget.Toast;

/**
 * Created by lotus on 11/04/16.
 */

import DialogImage.DialogImage;

public class DialogImageListener implements View.OnClickListener {

    DialogImage dialogImage;

    public DialogImageListener()
    {

    }

    @Override
    public void onClick(View v) {
        dialogImage.showZoomImage(v);
    }

    public void setDialogImage(DialogImage dialogImageParam)
    {
        dialogImage = dialogImageParam;
    }

}
